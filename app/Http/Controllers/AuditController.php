<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Asignable;
use App\Estado;
use App\Activo;
use App\Audit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use PDF;
use App\Exports\ExportProduct;
use App\Imports\ProductsImport;
use DB;
use App\User;


class AuditController extends Controller
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

        $producs = Product::orderBy('sn','ASC')
            ->get()
            ->pluck('sn','id');
            
        $user = User::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        
        $activo = Activo::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');    
        
        $audit = Audit::all();

        return view('audit.index', compact('audit','category','asignable','estado','producs','user','activo'));
        
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

    $producs = Product::orderBy('sn','ASC')
        ->get()
        ->pluck('sn','id');
        
    $user = User::orderBy('name','ASC')
        ->get()
        ->pluck('name','id');
    
    $activo = Activo::orderBy('name','ASC')
        ->get()
        ->pluck('name','id');    
    
    $audit = Audit::find($id);

    return view('audit.show', compact('audit','category','asignable','estado','producs','user','activo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
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
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
    }

    public function apiAudits(Request $request){
        $audit = Audit::all();
        
        return Datatables::of($audit)
            ->addColumn('user_id_name', function ($audit){
                if($audit->user == NULL){
                    return 'quien es?';
                }
                return $audit->user->name;
            })
            ->addColumn('action', function($audit){                
                return '<a onclick="showForm('. $audit->id .')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ';
                //  .
                //     '<a onclick="editForm('. $audit->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                //     '<a onclick="deleteData('. $audit->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })        
            ->rawColumns(['user_id_name','action'])->make(true);

    }






}
