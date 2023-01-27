@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Productos</h3>
            
            <div class="box-header">
                <a onclick="addForm()" class="btn btn-primary" >Agregar Productos</a>
                <a href="{{ route('exportPDF.productAll') }}" class="btn btn-danger">Export PDF</a>
                <a href="{{ route('exportExcel.productAll') }}" class="btn btn-success">Export Excel</a>
                {{-- <a href="{{ route('import.product') }}" class="btn btn-warning">Importar Excel</a> --}}
            </div>
            {{-- <a onclick="addForm()" class="btn btn-primary pull-right" style="margin-top: -8px;">Agregar Productos</a> --}}
        </div>
 
  {{-- {{$producs}}   --}}
        <!-- /.box-header -->
        <div class="box-body">
            <table id="products-table" class="table table-hover table-condensed responsive nowrap">
                <thead>
                <tr>
                    <th>ID</th>                    
                    <th>Nombre</th>
                    <th>S/N</th>
                    <th>Estado</th>
                    <th>Nombre de Red</th>
                    <th>Imagen</th>
                    <th>Categoria</th>
                    <th>Asignado a</th>
                    <th>Accion</th>
                </tr>
                </thead>

                {{-- @foreach($producs as $i)
                    <tbody>
                    <td>{{ $i->id }}</td>
                    <td>{{ $i->nama }}</td>
                    <td>{{ $i->sn }}</td>
                    <td>{{ $i->supplier }}</td>
                    <td>{{ $i->qty }}</td>
                    <td>{{ $i->image }}</td>
                    <td>{{ $i->category->name }}</td>
                    <td>{{ $i->customer->nama }}</td>
                    <td>
                        <a href="{{ route('products.show', [ 'id' => $i->id ]) }}" class="btn btn-sm btn-danger">show</a>
                        
                    </td>
                    </tbody>
                @endforeach --}}

                
                <tbody></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

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
                <div class="form-group">
                        <p>Ejemplo de excel de importacion</p>
                    <img class="rounded-square" width="800" height="200"  src="upload/ejemplos/eip.JPG" alt="Ejemplo">
                </div>  
                <!-- /.box-header -->
                <!-- form start -->
    <form role="form"  action="{{ route('import.product') }}" method="post" enctype="multipart/form-data">
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
    

    @include('products.form')

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
        var table = $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            scrollY: 650,
            "language": {"url": "assets/plugins/español.json"},
            ajax: "{{ route('api.products') }}",
            columns: [
                {data: 'id', name: 'id'},               
                {data: 'activo_name', name: 'activo_name'},
                {data: 'sn', name: 'sn'},
                // {data: 'show_photo', name: 'show_photo'},
                {data: 'estado_name', name: 'estado_name'},
                {data: 'qty', name: 'qty'},
                {data: 'show_photo', name: 'show_photo'},
                {data: 'category_name', name: 'category_name'},
                {data: 'asignable_name', name: 'asignable_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Agregar Productos');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('products') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Editar Producto');
                    $('#id').val(data.id);
                    $('#sn').val(data.sn);
                    $('#activo_id').val(data.activo_id);
                    $('#estado_id').val(data.estado_id);
                    $('#qty').val(data.qty);
                    $('#category_id').val(data.category_id);
                    $('#asignable_id').val(data.asignable_id);
                    $('#descripcion').val(data.descripcion);
                },
                error : function() {
                    alert("Nothing Data");
                }
            });
        }


        function showForm(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');       
                location.href="{{url('products')}}"+'/'+id;
                // alert(id);
        }

        // function showNombreRed(id) {
        //     var csrf_token = $('meta[name="csrf-token"]').attr('content');       
        //         // location.href="{{url('products')}}"+'/'+id;
        //         return redirect()->away(id);
        //         // alert(id);
        // }

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
                    url : "{{ url('products') }}" + '/' + id,
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
                    if (save_method == 'add') url = "{{ url('products') }}";
                    else url = "{{ url('products') . '/' }}" + id;

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
