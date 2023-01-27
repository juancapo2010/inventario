<?php

namespace App\Http\Controllers;

use App\Activo;
use App\Imports\ActivosImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use PDF;

class ActivoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('role:admin,staff', ['except' =>['index','apiActivos','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activos = Activo::all();
        // $ip=  \Request::ip();
        return view('activos.index', compact('activos'));
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
            'name'      => 'required',
            // 'alamat'    => 'required',
            // 'email'     => 'required|unique:Activos',
            // 'telepon'   => 'required',
        ]);

        Activo::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Activo Created'
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
        $activo = Activo::Find($id);
        return view('activos.show', compact('activo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activo = Activo::find($id);
        return $activo;
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
            'name'      => 'required|string|min:2',
            // 'alamat'    => 'required|string|min:2',
            // 'email'     => 'required|string|email|max:255|unique:Activos',
            // 'telepon'   => 'required|string|min:2',
        ]);

        $activo = Activo::findOrFail($id);

        $activo->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Activo Updated'
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
        Activo::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Activo Delete'
        ]);
    }

    public function apiActivos()
    {
        $activo = Activo::all();

        return Datatables::of($activo)
            ->addColumn('action', function($activo){
                return '<a onclick="showForm('. $activo->id .')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $activo->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $activo->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function ImportExcel(Request $request)
    {
        //Validasi
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            //UPLOAD FILE
            $file = $request->file('file'); //GET FILE
            Excel::import(new ActivosImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data Activos !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }


    public function exportActivosAll()
    {
        $activos = Activo::all();
        $pdf = PDF::loadView('Activos.ActivosAllPDF',compact('activos'));
        return $pdf->download('Activos.pdf');
    }

    public function exportExcel()
    {
        return (new ExportActivos)->download('activos.xlsx');
    }

}
