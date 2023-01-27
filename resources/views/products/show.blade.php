@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Productos</h3>

        {{-- <a href="{{url('products',5)}}">asd</a> --}}
        <div class="box-header">
            <a href="{{ route('exportPDF.product', $producs->id) }}" class="btn btn-success">Etiqueta de producto</a>
        </div>
        
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
<?php $asignable_id = $producs->asignable->id ?>
        <div class="container">
            <div class="col-sm-4">
               
                <div class="box-body">
                    <div class="form-group">
                        <label >Nombre</label>
                        {{$producs->activo->name}}
                    </div>

                    <div class="form-group">
                        <label >S/N</label>
                        {{$producs->sn}}
                    </div>

                    <div class="form-group">
                        <label >Estado</label>
                        {{$producs->estado->nama}}
                    </div>

                    <div class="form-group">
                        <label >Nombre de Red</label>
                        {{$producs->qty}}
                    </div>

                    <div class="form-group">
                        <label >Categoria</label>
                        {{$producs->category->name}}
                    </div>

                    <div class="form-group">
                        <label >Asignado a</label>
                    <a href="{{route('asignables.show',$asignable_id)}}">{{$producs->asignable->nama}}</a>
                    </div>

                    <div class="form-group">
                        <label >creado el</label>
                        {{$producs->created_at}}
                    </div>

                    <div class="form-group">
                        <label >modificado el</label>
                        {{$producs->updated_at}}
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                    <div class="form-group">
                        @if($producs->image)
                        <img class="rounded-square" width="500" height="500"  src={{url($producs->image)}} alt="">
                        @endif
                    </div>
            </div>

            <div class="col-sm-12">
                <label >Descripcion</label>
                <textarea >{{$producs->descripcion}}</textarea>
            </div>



        </div>
                <!-- /.box-body -->

            </div>

        </form>
        </div>


        <!-- /.box-body -->
    </div>

    @include('products.form')

@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>



@endsection
