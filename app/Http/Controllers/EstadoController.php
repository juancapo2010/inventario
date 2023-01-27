<?php

namespace App\Http\Controllers;


use App\Estado;
use App\Exports\ExportEstados;
use App\Imports\EstadosImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use PDF;


// --Estado
class EstadoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('role:admin,staff', ['except' =>['index','apiEstados','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = Estado::all();
        return view('estados.index', compact('estados'));
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
            'nama'      => 'required',
            // 'alamat'    => 'required',
            // 'email'     => 'required|unique:estados',
            // 'telepon'   => 'required',
        ]);

        Estado::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'estados Created'
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
        $estado = Estado::find($id);
        return $estado;
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
            'nama'      => 'required|string|min:2',
            // 'alamat'    => 'required|string|min:2',
            // 'email'     => 'required|string|email|max:255|unique:estados',
            // 'telepon'   => 'required|string|min:2',
        ]);

        $estado = Estado::findOrFail($id);

        $estado->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'estado Updated'
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
        Estado::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'estado Delete'
        ]);
    }

    public function apiestados()
    {
        $estado = Estado::all();

        return Datatables::of($estado)
            ->addColumn('action', function($estado){
                return '<a onclick="editForm('. $estado->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $estado->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
            Excel::import(new EstadosImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data estados !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }

    
    public function exportestadosAll()
    {
        $estados = Estado::all();
        $pdf = PDF::loadView('estados.estadosAllPDF',compact('estados'));
        return $pdf->download('estados.pdf');
    }

    public function exportExcel()
    {
        return (new ExportEstados)->download('estados.xlsx');
    }
}
