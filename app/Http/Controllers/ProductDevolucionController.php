<?php

namespace App\Http\Controllers;


use App\Exports\ExportProdukDevolucion;
use App\Product;
use App\Product_Devolucion;
use App\Estado;
use App\Asignable;
use App\Activo;
use PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

// --Entrada
class ProductDevolucionController extends Controller
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

        $estados = Estado::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');

        $asignables = Asignable::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');

        $activo = Activo::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $invoice_data = Product_Devolucion::all();
        return view('product_devolucion.index', compact('products','estados','asignables','invoice_data','activo'));
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
            'estado_id'    => 'required',
            'qty'            => 'required',
            'tanggal'        => 'required',
            'asignable_id'        => 'required'
        ]);

        Product_Devolucion::create($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->asignable_id = $request->asignable_id;
        $product->estado_id = $request->estado_id;
        $product->qty = $request->qty;
        $product->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Products In Created'
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
        $product_devolucion = Product_Devolucion::find($id);
        return $product_devolucion;
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
            'estado_id'    => 'required',
            'qty'            => 'required',
            'tanggal'        => 'required',
            'asignable_id'        => 'required'
        ]);

        $product_devolucion = Product_Devolucion::findOrFail($id);
        $product_devolucion->update($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->asignable_id = $request->asignable_id;
        $product->estado_id = $request->estado_id;
        $product->qty = $request->qty;
        $product->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Product In Updated'
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
        Product_Devolucion::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Products In Deleted'
        ]);
    }



    public function apiProductsIn(){
        $product = Product_Devolucion::all();

        return Datatables::of($product)
            ->addColumn('products_name', function ($product){
                return $product->product->activo->name;
            })
            ->addColumn('products_sn', function ($product){
                return $product->product->sn;
            })
            ->addColumn('estado_name', function ($product){
                return $product->estado->nama;
            })
            ->addColumn('action', function($product){
                return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';


            })
            ->rawColumns(['products_name','estado_name','action','products_sn'])->make(true);

    }

    public function exportProductdevolucionAll()
    {
        $product_devolucion = Product_Devolucion::all();
        $pdf = PDF::loadView('product_devolucion.productdevolucionAllPDF',compact('product_devolucion'));
        return $pdf->stream('product_devolucion.pdf');
    }

    public function exportProductdevolucion($id)
    {
        $product_devolucion = Product_Devolucion::findOrFail($id);
        $pdf = PDF::loadView('product_devolucion.productdevolucionPDF', compact('product_devolucion'));
        return $pdf->stream($product_devolucion->id.'_product_devolucion.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProdukDevolucion)->download('product_devolucion.xlsx');
    }
}
