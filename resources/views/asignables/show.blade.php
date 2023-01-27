@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Asignable</h3>

        {{-- <a href="{{url('products',5)}}">asd</a> --}}
        {{-- <div class="box-header">
            <a href="{{ route('exportPDF.product', $asignable->id) }}" class="btn btn-success">Etiqueta de producto</a>
        </div> --}}
        
        </div>
    
        <!-- /.box-Show -->
 

        <form  id="form-item" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
            {{ csrf_field() }} {{ method_field('POST') }}
            @csrf

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>


            <div class="modal-body">
                <input type="hidden" id="id" name="id">

        <div class="container">
            <div class="col-sm-4">
               
                <div class="box-body">
                    <div class="form-group">
                        <label >Nombre</label>
                        {{$asignable->nama}}
                    </div>

                    <div class="form-group">
                        <label >E-Mail</label>
                        {{$asignable->email}}
                    </div>

                    <div class="form-group">
                        <label >Sector</label>
                        {{$asignable->alamat}}
                    </div>

                    <div class="form-group">
                        <label >Telefono</label>
                        {{$asignable->telepon}}
                    </div>

                    <div class="form-group">
                        <label >creado el</label>
                        {{$asignable->created_at}}
                    </div>

                    <div class="form-group">
                        <label >modificado el</label>
                        {{$asignable->updated_at}}
                    </div>
                </div>
            </div>
            {{-- <div class="col-sm-8">
                    <div class="form-group">
                        
                        <img class="rounded-square" width="500" height="500"  src={{url($producs->image)}} alt="">
                    </div>
            </div> --}}

            <div class="col-sm-12">
                <label >Descripcion</label>
                {{-- {{$producs->asignable->nama}} --}}
            </div>



        </div>
                <!-- /.box-body -->

            </div>

        </form>
        </div>


        <!-- /.box-body -->
    </div>

    @include('asignables.form')

@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>



@endsection
