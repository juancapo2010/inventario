<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  id="form-item" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>
                <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
                <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
                
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> --}}
                <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">


                    <div class="box-body">
                        <div class="form-group">
                            <label >Nombre</label>
                            {!! Form::select('activo_id', $activo, null, ['class' => 'form-control select', 'placeholder' => '-- Seleccione activo --', 'id' => 'activo_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >S/N</label>
                            <input type="text" class="form-control" id="sn" name="sn"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Estado</label>
                            {!! Form::select('estado_id', $estado, null, ['class' => 'form-control select', 'placeholder' => '-- Seleccione estado --', 'id' => 'estado_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Nombre de Red</label>
                            <input type="text" class="form-control" id="qty" name="qty"   required>
                            <span class="help-block with-errors"></span>
                        </div>


                        <div class="form-group">
                            <label >Imagen</label>
                            <input type="file" class="form-control" id="image" name="image" >
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Categoria</label>
                            {!! Form::select('category_id', $category, null, ['class' => 'form-control select', 'placeholder' => '-- Seleccione categoria --', 'id' => 'category_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Asignado a</label>
                            {!! Form::select('asignable_id', $asignable, null, ['class' => 'form-control selectpicker select', 'data-show-subtext'=>'false' ,'data-live-search'=>'true', 'placeholder' => '-- Seleccione asignacion --', 'id' => 'asignable_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label >Descripcion</label>
                            <textarea  type="text" rows="10" cols="40" class="form-control" id="descripcion" name="descripcion"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>



                    </div>
                    <!-- /.box-body -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
