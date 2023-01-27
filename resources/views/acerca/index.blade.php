@extends('layouts.master')

@section('top')
@endsection

@section('content')


@if(\Session::has('success'))
<div class="alert alert-success">
    {{\Session::get('success')}}
</div>
@endif
@if(\Session::has('danger'))
<div class="alert alert-danger">
    {{\Session::get('danger')}}
</div>
@endif


<div class="container">
    <div class="jumbotron">
            <h1>Newsan Stock!</h1>
            <p>Control de Inventario</p>
            
          </div>
        
        
              <div class="row marketing text-center">
                <div class="col-md-11">
                        <h4>Introducción:</h4>
                                <p>A grandes rasgos, el sistema debe poder:
                                Almacenar un modelo de la estructura general de recursos IT, con el fin de poder ubicar cada recurso en sus edificios y sedes, con el fin de poder asignar el recurso a un usuario o sector. Se debe poder dar de alta, baja y modificar con robustez recursos, categorías, asignables y estados. También se debe poder imprimir etiqueta de recurso con sus datos. También se debe poder llevar registro de los usuarios que realizan las ABM y la asignación de recurso y por último se debe poder exportar los datos a otros medios. Dada esta necesidad, el sistema también debe brindar al usuario un formulario de acceso con contraseña.</p>
                                
                                <h4>Características</h4>
                                <p> La aplicación web está destinada para tres tipos de usuarios. Para el usuario administrador (Admin) debe poseer un cargo que le permita gestionar todos los recursos, como son el alta, baja y modificación de usuarios y control total de la app. Deberá ser el responsable de la app. El siguiente usuario (Staff) sería un/a secretario/a que se encarga de una gestión más reducida, deberá poder usar la aplicación esté podría desenvolverse como personal de soporte, o controlador. Por ultimo un nivel de visualización Lo único que requiere este usuario es ver la información en la app.</p>
                                
                                <h4>Entorno de desarrollo.</h4>
                                <p> Para el desarrollo de la aplicación, se utilizará PHP como lenguaje de programación web con el
                                framework Laravel (que utiliza el patrón Modelo-Vista-Controlador para la arquitectura del sistema), el conjunto de herramientas Bootstrap para el diseño de interfaces de usuario, Centos 7 para utilizar Apache como servidor HTTP Maria DB como motor de bases de datos relacional, para gestionar el desarrollo en equipo, se utilizará un servidor provisto por hosting sin módulo de control de versiones y como editor de texto se utilizará Visual Estudio CODE.
                                </p>
                </div>
                
            
        
            </div> <!-- /container -->
        </div>


@endsection