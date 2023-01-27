<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('user.png') }} " class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name  }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Opciones</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('/home') }}"><i class="fa fa-home"></i> <span>Tablero</span></a></li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-exchange"></i> <span>Entregas y devoluciones</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{ route('productsOut.index') }}"><i class="fa fa-arrow-right"></i> <span>Producto Salida</span></a></li>
                <li class="active"><a href="{{ route('productsIn.index') }}"><i class="fa fa-arrow-left"></i> <span>Producto Entrada</span></a></li>
              </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Producto</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{ route('products.index') }}"><i class="fa fa-circle-o"></i> Todos</a></li>
                  <li><a href="{{ route('api.filtro') }}"><i class="fa fa-circle-o"></i> Filtros</a></li>
                </ul>
              </li>
            <li class="active"><a href="{{ route('categories.index') }}"><i class="fa fa-bug"></i> <span>Categoria</span></a></li>
            <li class="active"><a href="{{ route('activos.index') }}"><i class="fa fa-apple"></i> <span>Activos</span></a></li>
            <li class="active"><a href="{{ route('asignables.index') }}"><i class="fa fa-user-plus"></i> <span>Asignable</span></a></li>
            <li class="active"><a href="{{ route('estados.index') }}"><i class="fa fa-check"></i> <span>Estados</span></a></li>

            {{-- <li class="active"><a href="{{ route('users.index') }}"><i class="fa fa-link"></i> <span>Usuarios</span></a></li> --}}
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-folder"></i> <span>Acceso</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                  <li><a href="{{ route('auditorias.index') }}"><i class="fa fa-circle-o"></i> Auditoria</a></li>
                </ul>
              </li>

            <li>
                <a href="#">
                  <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                  <small class="label pull-right bg-red">PDF</small>
                </a>
              </li>
              <li>
                <a href="{{ route('acerca') }}">
                  <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                  <small class="label pull-right bg-yellow">IT</small>
                </a>
              </li>







        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
