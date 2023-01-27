@extends('layouts.master')


@section('content')
    <h1>Crear Usuario</h1>
    <hr>
    <form action="{{ route('user.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{-- {{$errors->all()}} --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </div><br />
        @endif
        <div class="box-body">
            <div class="form-group col-sm-6">
                <input type="hidden" value="{{csrf_token()}}" name="_token" />
                <label for="name">Nombre</label>
                <input type="text" value="{{old('name')}}" class="form-control" name="name" placeholder="Nombre">
                
            </div>

            <div class="form-group col-sm-6">
                <label for="email">Email</label>
                <input type="email" value="{{old('email')}}" class="form-control" name="email" placeholder="Email de usuario">
            </div>

            <div class="form-group col-sm-6">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" placeholder="Ingrese Contraseña">
            </div>

            <div class="form-group col-sm-6">
                <label for="password-confirm">Repita contraseña</label>
                <input type="password" class="form-control" name="password-confirm" placeholder="Confirmar contraseña">
            </div>

            <div class="form-group col-sm-12">
                <label >Roll</label>
                <select class="form-control select" id="role" name="role"   required>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="noob">Noob</option>
                </select>
    
                <span class="help-block with-errors"></span>
            </div>

            <div class="form-group col-sm-12">
                <div class="box-footer">

                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
            </div>
            <!-- /.box-body -->
        </div>
    </form>
@endsection