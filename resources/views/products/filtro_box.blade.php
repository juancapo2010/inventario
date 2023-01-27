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
                        
                        <th>Categoria</th>
                        <th>Asignado a</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
    
                    @foreach($producs as $i)
                        <tbody>
                        <td>{{ $i->id }}</td>
                        <td>{{ $i->activo->nama }}</td>
                        <td>{{ $i->sn }}</td>
                        <td>{{ $i->supplier->nama }}</td>
                        <td>{{ $i->qty }}</td>
                        
                        <td>{{ $i->category->name }}</td>
                        <td>{{ $i->customer->nama }}</td>
                        <td>
                            <a href="{{ route('products.show', [ 'id' => $i->id ]) }}" class="btn btn-sm btn-danger">Ver</a>
                            
                        </td>
                        </tbody>
                    @endforeach
    
                    
                    <tbody></tbody>
                </table>
            </div>