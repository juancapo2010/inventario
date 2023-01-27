
@extends('layouts.master')


@section('content')
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


@section('content')
    <h1>Usuario</h1>
    <hr>
             
    {{ $pass = Auth::user()->Password}}
    
                <div class="box-body">  
                    <div class="container">

                            <div class="row">
                                    <div class="col-sm-9">
                                      
                                      <div class="row">
                                        <div class="col-xs-8 col-sm-6">
                                                <div class="form-group box-footer">                                    
                                                        <p><strong>Nombre : </strong>     {{ $user->name }}</p>
                                                    </div>
                                                    <div class="form-group box-footer">
                                                        <p><strong>Email : </strong>      {{ $user->email }}</p>
                                                    </div>
                                                    <div class="form-group box-footer">
                                                        <p><strong>Roll : </strong>      {{ $user->role }}</p>
                                                    </div>
                                                    <div class="form-group box-footer">
                                                        <p><strong>Fecha de creacion : </strong>      {{ $user->created_at }}</p>
                                                    </div>
                                                    <div class="form-group box-footer">
                                                        <p><strong>Fecha de actualizacion : </strong>      {{ $user->updated_at }}</p>
                                                    </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-6">
                                          <img src="{{ asset('user.png') }}" alt="..." class="img-thumbnail" width="320" height="320">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                </div>
                <div class="container">
                        <div class="row"> 
                    {{-- <a href="{{url('user/password')}}" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i> cambiar contraseña</a> --}}
                    {{-- <button id="myModalPassword" type="submit" class="btn btn-info">cambiar contraseña</button> --}}

                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
                            cambiar contraseña
                          </button>
                          
                          <!-- Modal -->
                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="myModalLabel">Cambiar Contraseña</h4>
                                </div>
                                <div class="modal-body">
                                        <form method="post" action="{{url('user/updatepassword', $user)}}">
                                            {{csrf_field()}}
                                            @if (Session::has('message'))
                                                <div class="text-danger">
                                                {{Session::get('message')}}
                                                </div>
                                            @endif
                                            
                                            {{-- <div class="form-group">
                                             <label for="">Introduce tu actual password:</label>
                                             <input type="password" name="password" class="form-control">
                                             <div class="text-danger">{{$errors->first('mypassword')}}</div>
                                            </div> --}}
                                            <div class="form-group">
                                             <label for="newpassword">Introduce tu nuevo password:</label>
                                             <input type="password" name="newpassword" class="form-control">
                                             <div class="text-danger">{{$errors->first('password')}}</div>
                                            </div>
                                            {{-- <div class="form-group">
                                             <label for="repassword">Confirma tu nuevo password:</label>
                                             <input type="password" name="repassword" class="form-control">
                                            </div> --}}
                                            <button type="submit" class="btn btn-primary">Cambiar mi password</button>
                                           </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                  {{-- <button type="submit" class="btn btn-primary">Guardar</button> --}}
                                </div>
                              </div>
                            </div>
                          </div>

                    <form method="post" action="{!! action('UserController@destroy', $user->id) !!}" class="pull-left">
                            {!! csrf_field() !!}
                            <div>
                                <button type="submit" class="btn btn-warning">Borrar</button>
                            </div> 
                        </form>
                        </div>
                </div>
                </div>

                      <!-- Button trigger modal -->

 
@stop
@endsection