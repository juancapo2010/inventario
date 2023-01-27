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
            <h3 class="box-title">Auditoria</h3>
        </div>

        <div class="box-header">
            {{-- <a onclick="addForm()" class="btn btn-primary" >Agregar Usuario</a> --}}
            {{-- <a href="{{ route('user.new') }}" class="btn btn-primary" >Agregar Usuario</a> --}}
            {{-- <a href="{{ route('exportPDF.suppliersAll') }}" class="btn btn-danger">Export PDF</a> --}}
            {{-- <a href="{{ route('exportExcel.suppliersAll') }}" class="btn btn-success">Export Excel</a> --}}
        </div>




        <!-- /.box-header -->
			<div class="box-body">
                    <table id="audits-table" class="table table-hover table-condensed responsive nowrap">
                        <thead>
                            <tr>
                                <th >#</th>
                                {{-- <th >Tipo de usuario</th> --}}
                                <th >Usuario</th>
                                <th >Evento</th>
                                <th >Tipo de auditable</th>
                                {{-- <th >auditado</th> --}}
                                <th >Valor viejo</th>
                                <th >Valor nuevo</th>
                                {{-- <th >url</th> --}}
                                {{-- <th >ip</th> --}}
                                {{-- <th >Sistema</th> --}}
                                {{-- <th >tag</th> --}}
                                {{-- <th >Fecha</th> --}}
                                {{-- <th >Actualizacion</th> --}}
                                <th >accion</th>
                                
                            </tr>
                        </thead>
    
                            {{-- @foreach($audit as $a)
                            <tr>
                                <td>{{$a->id}}</td>
                                <td>{{$a->uder_type}}</td>
                                <td>{{$a->user->name}}</td>
                                <td>{{$a->event}}</td>
                                <td>{{$a->auditable_type}}</td>
                                <td>{{$a->auditable_id}}</td>
                                <td>{{$a->old_values}}</td>
                                <td>{{$a->new_values}}</td>
                                <td>{{$a->url}}</td>
                                <td>{{$a->ip_addres}}</td>
                                <td>{{$a->user_agent}}</td>
                                <td>{{$a->created_at}}</td>
    
                               
                            </tr>
                            @endforeach --}}
                        </tbody></table>
                    </div>

                
                    <!-- /.box-body -->


                    @endsection
                    @section('bot')                

                        <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    {{--<script>--}}
    {{--$(function () {--}}
    {{--$('#items-table').DataTable()--}}
    {{--$('#example2').DataTable({--}}
    {{--'paging'      : true,--}}
    {{--'lengthChange': false,--}}
    {{--'searching'   : false,--}}
    {{--'ordering'    : true,--}}
    {{--'info'        : true,--}}
    {{--'autoWidth'   : false--}}
    {{--})--}}
    {{--})--}}
    {{--</script>--}}
                    <script type="text/javascript">
                        var table = $('#audits-table').DataTable({
                            processing: true,
                            serverSide: true,
                            responsive: true,
                            scrollY: 400,
                            "language": {"url": "assets/plugins/español.json"},
                            ajax: "{{ route('api.audits') }}",
                            columns: [
                                {data: 'id', name: 'id'},               
                                // {data: 'user_type', name: 'user_type'},
                                {data: 'user_id_name', name: 'user_id_name'},
                                {data: 'event', name: 'event'},
                                {data: 'auditable_type', name: 'auditable_type'},
                                // {data: 'auditable_id', name: 'auditable_id'},
                                {data: 'old_values', name: 'old_values'},
                                {data: 'new_values', name: 'new_values'},
                                // {data: 'url', name: 'url'},
                                // {data: 'ip_address', name: 'ip_address'},
                                // {data: 'user_agent', name: 'user_agent'},
                                // {data: 'tags', name: 'tags'},
                                // {data: 'created_at', name: 'created_at'},
                                // {data: 'updated_at', name: 'updated_at'},
                                {data: 'action', name: 'action', orderable: false, searchable: false},
                            ]
                        });

                    function showForm(id) {
                    var csrf_token = $('meta[name="csrf-token"]').attr('content');       
                    location.href="{{url('audit')}}"+'/'+id;
                    // alert(id);
                    }
                

                    </script>
                    

                    @endsection
        