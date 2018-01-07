<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    {{-- <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" /> --}}
                    <img src="/img/avatar.png" class="img-circle" alt="Imagen" />

                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            {{-- <li><a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.anotherlink') }}</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.multilevel') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                </ul>
            </li> --}}


            {{-- MODULO INGREDIENTES --}}

            @role('admin')
            <li class="treeview">
                <a href="#"><i class='sidebar-seguridad fa fa-list-alt'></i> <span>Ingredientes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('ingredientes/añadir')}}">Añadir</a></li>
                    <li><a href="{{url('ingredientes/crud')}}">Administrar</a></li>
                    {{-- <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li> --}}
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='sidebar-seguridad fa fa-flask'></i> <span>Preparados</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu ">
                    <li class=""><a href="{{url('preparados/añadir')}}">Añadir</a></li>
                    <li><a href="{{url('preparados/crud')}}">Administrar</a></li>
                    {{-- <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li> --}}
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class='sidebar-seguridad fa fa-id-card'></i> <span>Proveedores</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('proveedores/añadir')}}">Añadir</a></li>
                    <li><a href="{{url('proveedores/crud')}}">Administrar</a></li>
                    {{-- <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li> --}}
                </ul>
            </li>
            @endrole

            @role('quimico')
            <li class="treeview">
                <a href="#"><i class='sidebar-seguridad fa fa-list-alt'></i> <span>Ingredientes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('ingredientes/crud')}}">Administrar</a></li>
                    {{-- <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li> --}}
                </ul>
                <li class="treeview">
                <a href="#"><i class='sidebar-seguridad fa fa-flask'></i> <span>Preparados</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('preparados/crud')}}">Administrar</a></li>
                    {{-- <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li> --}}
                </ul>
            </li>
            </li>
            @endrole

            {{-- FIN DE MODULO INGREDIENTES --}}

            {{-- MODULO RESERVAS --}}


            @role('cliente')
            <li class="treeview">
                <a href="#"><i class='sidebar-seguridad fa fa-tags'></i> <span>Reservas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('reservas/crear')}}">Crear</a></li>
                    <li><a href="{{url('reservas/historial')}}">Ver Historial</a></li>
                    {{-- <li><a href="{{url('admin/roles')}}">Roles</a></li> --}}
                    {{-- <li><a href="{{url('admin/permissions')}}">Permisos</a></li> --}}
                    {{-- <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li> --}}
                </ul>
            </li>
            
            @else

            <li class="treeview">
                <a href="#"><i class='sidebar-seguridad fa fa-tags'></i> <span>Reservas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    {{-- <li><a href="{{url('reservas/historial')}}">Ver Historial</a></li> --}}
                    <li><a href="{{url('reservas/crear')}}">Crear</a></li>
                    <li><a href="{{url('reservas/crud')}}">Administrar</a></li>
                </ul>
            </li>

            @endrole

            {{-- FIN MODULO RESERVAS --}}

            {{-- MODULO USUARIOS --}}
            @role('admin')
            <li class="treeview">
                <a href="#"><i class='sidebar-seguridad fa fa-users'></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('admin/users')}}">Administrar</a></li>
                    {{-- <li><a href="{{url('admin/roles')}}">Roles</a></li> --}}
                    {{-- <li><a href="{{url('admin/permissions')}}">Permisos</a></li> --}}
                    {{-- <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li> --}}
                </ul>
            </li>
            @endrole

            {{-- FIN MODULO USUARIOS --}}



            {{--  MODULO REPORTES --}}
            @role('admin')
            <li class="treeview">
                <a href="#"><i class='sidebar-reportes fa fa-area-chart'></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    {{-- <li><a href="{{url('Reportes')}}">Reportes</a></li> --}}
                    <li><a href="{{url('graficas/ver')}}">Graficas</a></li>
                </ul>
            </li>
            @endrole
            {{-- FIN MODULO REPORTES --}}

        </ul><!-- /.sidebar-menu -->

    </section>
    <!-- /.sidebar -->
</aside>
