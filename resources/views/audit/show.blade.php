@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Auditoria</h3>
        
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
                        <label >ID</label>
                        {{$audit->id}}
                    </div>

                    <div class="form-group">
                        <label >Usuario</label>
                        {{$audit->user_type}}
                        
                    </div>

                    <div class="form-group">
                        <label >Nombre</label>
                        {{$audit->user->name}}
                    </div>

                    <div class="form-group">
                        <label >Operacion</label>
                        {{$audit->event}}
                    </div>

                    <div class="form-group">
                        <label >Objeto</label>
                        {{$audit->auditable_type}}
                    </div>

                    <div class="form-group">
                        <label >id auditado</label>
                        {{$audit->auditable_id}}
                    </div>

                    <div class="form-group">
                        <label >Valor viejo</label>
                        {{$audit->old_values}}
                    </div>

                    <div class="form-group">
                        <label >valor nuevo</label>
                        {{$audit->new_values}}
                    </div>

                    <div class="form-group">
                        <label >URL</label>
                        {{$audit->url}}
                    </div>

                    <div class="form-group">
                        <label >IP</label>
                        {{$audit->ip_address}}
                    </div>

                    <div class="form-group">
                        <label >navegador</label>
                        {{$audit->user_agent}}
                    </div>
                    <div class="form-group">
                        <label >tags</label>
                        {{$audit->tags}}
                    </div>

                    <div class="form-group">
                        <label >creado el</label>
                        {{$audit->created_at}}
                    </div>

                    <div class="form-group">
                        <label >modificado el</label>
                        {{$audit->updated_at}}
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                    <div class="form-group">
                        @if($audit->image)
                        <img class="rounded-square" width="500" height="500"  src={{url($audit->image)}} alt="">
                        @endif
                    </div>
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
