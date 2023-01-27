<?php

namespace App\Http\Controllers;


use App\Asignable;
use App\Exports\ExportAsignables;
use App\Imports\AsignablesImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use PDF;



// --asignables--


class AsignableController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('role:admin,staff', ['except' =>['index','apiAsignables','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignables = Asignable::all();
        return view('asignables.index', compact('asignables'));
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
            // 'email'     => 'required|unique:asignables',
            // 'telepon'   => 'required',
        ]);

        Asignable::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'asignable Created'
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
        $asignable = Asignable::Find($id);
        return view('asignables.show', compact('asignable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asignable = Asignable::find($id);
        return $asignable;
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
            // 'email'     => 'required|string|email|max:255|unique:asignables',
            // 'telepon'   => 'required|string|min:2',
        ]);

        $asignable = Asignable::findOrFail($id);

        $asignable->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'asignable Updated'
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
        Asignable::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'asignable Delete'
        ]);
    }

    public function apiasignables()
    {
        $asignable = Asignable::all();

        return Datatables::of($asignable)
            ->addColumn('action', function($asignable){
                return '<a onclick="showForm('. $asignable->id .')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $asignable->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $asignable->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
            Excel::import(new AsignablesImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data asignables !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }


    public function exportasignablesAll()
    {
        $asignables = Asignable::all();
        $pdf = PDF::loadView('asignables.asignablesAllPDF',compact('asignables'));
        return $pdf->download('asignables.pdf');
    }

    public function exportExcel()
    {
        return (new ExportAsignables)->download('asignables.xlsx');
    }
}
