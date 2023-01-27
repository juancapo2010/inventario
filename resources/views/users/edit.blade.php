@extends('layouts.master')


@section('content')
    <h1>Editar Usuario</h1>
    <hr>
    {{Form::model($user, $form_data, array('role' =>'form'))}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                {{ Form::label('name', 'Nombre') }}
                {{ Form::text('name', null, array('placeholder' => 'Nombre', 'class' => 'form-control')) }}               
            </div>

            <div class="form-group col-sm-6">
                {{ Form::label('email', 'Dirección de E-mail') }}
                {{ Form::text('email', null, array('placeholder' => 'Email de usuario', 'class' => 'form-control')) }}
            </div>

            <div class="form-group col-sm-6">
                {{ Form::label('password', 'Contraseña') }}
                {{ Form::password('password', array('class' => 'form-control')) }}
            </div>

            <div class="form-group col-sm-6">
                {{ Form::label('password-confirm', 'Confirmar contraseña') }}
                {{ Form::password('password-confirm', array('class' => 'form-control')) }}
            </div>

            <div class="form-group col-sm-12">
                <label >Roll</label>
                {{-- {{ Form::label('role', 'Roll') }}
                {{ Form::text('role', null, array('placeholder' => 'Roll', 'class' => 'form-control', 'value'=>'')) }} --}}
                <select class="form-control select" id="role" name="role" value="{{ old('role', $user->role)}}"   required>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="noob">Noob</option>
                </select>
    
                <span class="help-block with-errors"></span>
            </div>

            <div class="form-group col-sm-12">
                <div class="box-footer">
                {{ Form::button($action . ' usuario', array('type' => 'submit', 'class' => 'btn btn-primary')) }} 
            </div>
            </div>
            <!-- /.box-body -->
        </div>
        {{ Form::close() }}

    
@endsection

