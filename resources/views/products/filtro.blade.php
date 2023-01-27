@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
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
            <h3 class="box-title">Inventario</h3>
        </div>

        <div class="box">     
                
                {{-- <div class="box-header">
 
                </div> --}}
                
            <div class="content">
                <form  id="form-item" method="GET" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                    {{ csrf_field() }} {{ method_field('GET') }}
                <div class="col-md-4">  {!! Form::select('category_id', $category, null, ['class' => 'form-control select', 'placeholder' => '-- Seleccione categoria --', 'id' => 'category_id']) !!}</div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </form>
            </div>
            
            </div>
    </div>
           
            <!-- /.box-header -->
            <div class="box">
            <div class="box-body">
                <table id="products-table" class="table table-hover table-condensed responsive nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>                    
                        <th>Nombre</th>
                        <th>S/N</th>
                        <th>Estado</th>
                        <th>Nombre de Red</th>
                        
                        <th>Categoria</th>
                        <th>Asignado a</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
    
                    @foreach($product as $i)
                        <tbody>
                        <td>{{ $i->id }}</td>
                        <td>{{ $i->activo->name }}</td>
                        <td>{{ $i->sn }}</td>
                        <td>{{ $i->estado->nama }}</td>
                        <td>{{ $i->qty }}</td>
                        
                        <td>{{ $i->category->name }}</td>
                        <td>{{ $i->asignable->nama }}</td>
                        <td>
                            <a href="{{ route('products.show', [ 'id' => $i->id ]) }}" class="btn btn-sm btn-danger">Ver</a>
                            
                        </td>
                        </tbody>
                    @endforeach
                    {{-- {{dd($product)}} --}}
                    <p>Cantidad de resultados :  {{$product->count()}}</p>
                    
                    @if($product->count()>0)
                    <a href="{{ route('exportPDF.productFiltro', [ 'id' => $i->category])}}" class="btn btn-danger">Export PDF</a>
                    @endif
                    <tbody></tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        

                    @endsection
        