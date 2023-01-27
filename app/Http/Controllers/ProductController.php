<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Asignable;
use App\Estado;
use App\Activo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use PDF;
use App\Exports\ExportProduct;
use App\Imports\ProductsImport;
use DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('role:admin,staff,', ['except' =>['index','apiProducts','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $asignable = Asignable::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama','id');
        
        $estado = Estado::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');
        
        $activo = Activo::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $producs = Product::all();

        return view('products.index', compact('category','asignable','estado','producs','activo'));
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
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        $asignable = Asignable::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');
        $estado = Estado::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');             
        $activo = Activo::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');   

        $this->validate($request , [
            'activo_id'          => 'required',
            'sn'            => 'required|unique:products',
            'estado_id'  => 'required',
            'qty'           => 'required',
            // 'image'         => 'required',
            'category_id'   => 'required',
            'asignable_id'   => 'required',
        ]);

        $input = $request->all();
        $input['image'] = null;

        if ($request->hasFile('image')){
            $input['image'] = '/upload/products/'.str_slug($input['sn'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

        Product::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Producto Creado'
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
        $category = Category::orderBy('name','ASC')
        ->get()
        ->pluck('name','id');

    $asignable = Asignable::orderBy('nama', 'ASC')
        ->get()
        ->pluck('nama','id');
    
    $estado = Estado::orderBy('nama','ASC')
        ->get()
        ->pluck('nama','id');

    $activo = Activo::orderBy('name','ASC')
        ->get()
        ->pluck('name','id');   

    $producs = Product::Find($id);
    // dd($producs);
    return view('products.show', compact('producs','category','asignable','estado','activo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        $asignable = Asignable::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');
        $estado = Estado::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');
        $activo = Activo::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');         
        $product = Product::find($id);
        return $product;
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
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        $asignable = Asignable::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');
        $estado = Estado::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');
        $activo = Activo::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');     

        $this->validate($request , [
            'activo_id'          => 'required',
            'sn'            => 'required|unique:products,sn,'.$request->id,
            'estado_id'  => 'required',
            'qty'           => 'required',
//            'image'         => 'required',
            'category_id'   => 'required',
            'asignable_id'   => 'required',
        ]);

        $input = $request->all();
        $produk = Product::findOrFail($id);

        $input['image'] = $produk->image;

        if ($request->hasFile('image')){
            if (!$produk->image == NULL){
                unlink(public_path($produk->image));
            }
            $input['image'] = '/upload/products/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

        $produk->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Producto Actualizado'
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
        $product = Product::findOrFail($id);

        if (!$product->image == NULL){
            unlink(public_path($product->image));
        }

        Product::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Producto Eliminado'
        ]);
    }

    public function apiProducts(Request $request){
        $product = Product::all();
        
        return Datatables::of($product)
            ->addColumn('category_name', function ($product){
                if($product->category == NULL){
                    return 'Sin categoria';
                }
                return $product->category->name;
            })
            ->addColumn('asignable_name', function ($product){
                if($product->asignable == NULL){
                    return 'No hay';
                }
                return $product->asignable->nama;
            })
            ->addColumn('estado_name', function ($product){
                if ($product->estado == NULL){
                    return "Nuevo";
                }
                return $product->estado->nama;
            })
            ->addColumn('show_photo', function($product){
                if ($product->image == NULL){
                    return 'Sin Imagen';
                }
                return '<img class="rounded-square" width="50" height="50" onmouseover="this.width=150;this.height=150;" onmouseout="this.width=50;this.height=50;" src="'. url($product->image) .'" alt="">';
            })
            ->addColumn('qty', function($product){
                if ($product->qty == NULL){
                    return 'Sin Imagen';
                }
                if($product->category->id == 1){
                    return '<a href="http://'.$product->qty.'" target="_blank">'.$product->qty.'</a>';
                }else{
                    return $product->qty;
                }
            })
            ->addColumn('activo_name', function ($product){
                if($product->activo == NULL){
                    return 'Sin activo';
                }
                return $product->activo->name;
            })
            ->addColumn('action', function($product){                
                return '<a onclick="showForm('. $product->id .')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
        
            ->rawColumns(['category_name','asignable_name','estado_name','show_photo','qty','action','activo_name'])->make(true);

    }

    public function exportProductAll()
    {
        $product = Product::all();
        $pdf = PDF::loadView('products.productAllPDF',compact('product'));
        return $pdf->stream('product.pdf');
    }

    public function exportProduct($id)
    {
        $product = Product::findOrFail($id);
        $pdf = PDF::loadView('products.productPDF', compact('product'));
        return $pdf->stream($product->id.'_product.pdf');
    }

    public function exportProductFiltro($id)
    {
    $category = Category::orderBy('name','ASC')
        ->get()
        ->pluck('name','id');

    $asignable = Asignable::orderBy('nama', 'ASC')
        ->get()
        ->pluck('nama','id');
    
    $estado = Estado::orderBy('nama','ASC')
        ->get()
        ->pluck('nama','id');
    $activo = Activo::orderBy('name','ASC')
        ->get()
        ->pluck('name','id');     
        $product = Product::with('category')->where('category_id', $id);
        $product = $product->get(); 
        $pdf = PDF::loadView('products.productAllPDF', compact('product','category','asignable','estado','activo'));
        return $pdf->stream('product.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProduct)->download('product.xlsx');
    }

    public function importExcel(Request $request)
    {
        //obtenemos el campo file definido en el formulario
        $file = $request->file('file');
         //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();
        //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('local')->put($nombre,  \File::get($file));
        Excel::import(new ProductsImport, $request->file('file'));
        return redirect('/products')->with('Genial', 'Todo Bien!');
    }


    public function filtro(Request $request)
    {

        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $asignable = asignable::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama','id');
        
        $estado = estado::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');

        $activo = Activo::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');     
        
            $product = Product::with('category')->where('category_id', $request->category_id);
              
        $product = $product->get();

        return view('products.filtro', compact('category','asignable','estado','product','activo'));
    }

    
}
