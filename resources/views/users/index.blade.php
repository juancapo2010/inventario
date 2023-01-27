@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    @include('sweet::alert')
@endsection

@section('content')
    <div class="box">

        	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach 
		</ul>
	</div><br />
	@endif

            @if(\Session::has('success'))
			<div class="alert alert-success">
				{{\Session::get('success')}}
			</div>
			@endif

        <div class="box-header">
            <h3 class="box-title">Usuarios</h3>
        </div>

        <div class="box-header">
            {{-- <a onclick="addForm()" class="btn btn-primary" >Agregar Usuario</a> --}}
            <a href="{{ route('user.new') }}" class="btn btn-primary" >Agregar Usuario</a>
            {{-- <a href="{{ route('exportPDF.suppliersAll') }}" class="btn btn-danger">Export PDF</a> --}}
            {{-- <a href="{{ route('exportExcel.suppliersAll') }}" class="btn btn-success">Export Excel</a> --}}
        </div>




        <!-- /.box-header -->
			<div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 10px" class="col-xs-2 col-md-1" >#</th>
                                <th class="col-xs-2 col-md-3">Nombre</th>
                                <th class="col-xs-2 col-md-3">Email</th>
                                <th class="col-xs-2 col-md-2">Roll</th>
                                <th class="col-xs-2 col-md-3">Acciones</th>
                            </tr>
    
                            @foreach($users as $usuario)
                            <tr>
                                <td>{{$usuario->id}}</td>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->email}}</td>
                                <td>{{$usuario->role}}</td>
    
                                <td>
                                <a href="{{route('users.show', ['id' => $usuario->id])}}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a>
                                <a href="{{route('users.edit', ['id' => $usuario->id])}}" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> 
                                <a href="{{route('users.destroy', ['id' => $usuario->id])}}" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody></table>
                    </div>

                
                    <!-- /.box-body -->

                    

                    @endsection
        