@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    @include('sweet::alert')
@endsection

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Asignables</h3>
        </div>

        <div class="box-header">
            <a onclick="addForm()" class="btn btn-primary" >Agregar Asignable</a>
            {{-- <a href="{{ route('exportPDF.asignablesAll') }}" class="btn btn-danger">Export PDF</a>
            <a href="{{ route('exportExcel.asignablesAll') }}" class="btn btn-success">Export Excel</a> --}}
        </div>


        <!-- /.box-header -->
        <div class="box-body">
            <table id="asignable-table" class="table table-striped responsive nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    {{-- <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th> --}}
                    <th>Accion</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    {{-- @include('asignables.form_import') --}}
    <div class="box">
        <div class="box-header with-border">
                <h3 class="box-title">Ingreso de datos masivos</h3>
                <br><br>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible ">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-check"></i> Success!&nbsp;
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-ban"></i> Error!&nbsp;
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
<form role="form"  action="{{ route('import.asignables') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="box-body">
        <div class="form-group">
            <label for="exampleInputFile" >
                Importar Archivo
            </label>
            <input type="file" id="file" name="file">
            <p class="text-danger">{{ $errors->first('file') }}</p>
        </div>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Subir</button>
    </div>
    <div class="box-body">
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> Atencion! &nbsp;
                Tipos de datos de archivo (.xls, .xlsx)
            </div>
            </div>
        </form>
    </div>


    @include('asignables.form')

@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>--}}

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
        var table = $('#asignable-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            scrollY: 400,
            "language": {"url": "assets/plugins/español.json"},
            ajax: "{{ route('api.asignables') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nama', name: 'nama'},
                // {data: 'alamat', name: 'alamat'},
                // {data: 'email', name: 'email'},
                // {data: 'telepon', name: 'telepon'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Agregar Asignables');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('asignables') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Editar Asignable');

                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    // $('#alamat').val(data.alamat);
                    // $('#email').val(data.email);
                    // $('#telepon').val(data.telepon);
                },
                error : function() {
                    alert("Nothing Data");
                }
            });
        }

        function showForm(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');       
                location.href="{{url('asignables')}}"+'/'+id;
                // alert(id);
        }

        function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    url : "{{ url('asignables') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error : function () {
                        swal({
                            title: 'Oops...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            });
        }

        $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('asignables') }}";
                    else url = "{{ url('asignables') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
                        //hanya untuk input data tanpa dokumen
//                      data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });
    </script>

@endsection
