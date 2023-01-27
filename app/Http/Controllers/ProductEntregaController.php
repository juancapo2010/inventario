<?php

namespace App\Http\Controllers;

use App\Category;
use App\Asignable;
use App\Estado;
use App\Activo;
use App\Exports\ExportProdukEntrega;
use App\Product;
use App\Product_Entrega;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PDF;
use Auth;


// --Salida
class ProductEntregaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('role:admin,staff');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('sn','ASC')
            ->get()
            ->pluck('sn','id');

        $asignables = Asignable::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');

        $estados = Estado::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');
            
        $activo = Activo::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');    

        $invoice_data = Product_Entrega::all();
        return view('product_entrega.index', compact('products','asignables','estados', 'invoice_data','activo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'product_id'     => 'required',
           'asignable_id'    => 'required',
           'qty'            => 'required',
           'tanggal'           => 'required',
        //    'tecnico'           => 'required',
           'estado_id'           => 'required'
        ]);
            
        $entrega = $request->all();
        // $tecnico = Auth::user()->name;
        // $entrega['tecnico'] = $tecnico;
        
        Product_Entrega::create($entrega);

        $product = Product::findOrFail($request->product_id);
        $product->asignable_id = $request->asignable_id;
        $product->estado_id = $request->estado_id;
        $product->qty = $request->qty;
        $product->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Producto Entregado'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_entrega = Product_Entrega::find($id);
        return $product_entrega;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_id'     => 'required|unique:products,sn,'.$request->id,
            'asignable_id'    => 'required',
            'qty'            => 'required',
            'tanggal'           => 'required',
            'estado_id'           => 'required'
        ]);

        $product_entrega = Product_Entrega::findOrFail($id);
        $product_entrega->update($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->asignable_id = $request->asignable_id;
        $product->estado_id = $request->estado_id;
        $product->qty = $request->qty;
        $product->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Product Out Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product_Entrega::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Products Delete Deleted'
        ]);
    }



    public function apiProductsOut(){
        $product = Product_Entrega::all();

        return Datatables::of($product)
            ->addColumn('products_name', function ($product){
                
                return $product->product->activo->name;
            })
            ->addColumn('products_sn', function ($product){
                return $product->product->sn;
            })
            
            ->addColumn('asignable_name', function ($product){
                return $product->asignable->nama;
            })
            ->addColumn('action', function($product){
                return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['products_name','asignable_name','action','products_sn'])->make(true);

    }

    public function exportProductentregaAll()
    {
        $product_entrega = Product_Entrega::all();
        $pdf = PDF::loadView('product_entrega.productentregaAllPDF',compact('product_entrega'));
        return $pdf->stream('product_entrega.pdf');
    }

    public function exportProductentrega($id)
    {
        $product_entrega = Product_Entrega::findOrFail($id);
        $pdf = PDF::loadView('product_entrega.productentregaPDF', compact('product_entrega'));
        return $pdf->stream($product_entrega->id.'_product_entrega.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProdukEntrega)->download('product_entrega.xlsx');
    }
}
