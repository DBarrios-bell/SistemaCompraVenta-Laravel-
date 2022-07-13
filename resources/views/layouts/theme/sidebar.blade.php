@auth
    <div class="sidebar-wrapper sidebar-theme">
        <nav id='compactSidebar'>
            <ul class="menu-categories">

                @can('1. Tab Categoria')
                    <li class="active">
                        <a href="{{ route('categorias') }}" class="menu-toggle" data-active='true'>
                            <div class="base-menu">
                                <div class="base-icons">
                                    <lord-icon src="https://cdn.lordicon.com/jvucoldz.json" trigger="loop-on-hover"
                                        colors="primary:#ffffff,secondary:#07a889" style="width:50px;height:50px">
                                    </lord-icon>
                                </div>
                                <span>CATEGORIAS</span>
                            </div>
                        </a>
                    </li>
                @endcan
                @can('2. Tab Producto')
                    <li class="">
                        <a href="{{ route('productos') }}" class="menu-toggle" data-active='false'>
                            <div class="base-menu">
                                <div class="base-icons">
                                    <lord-icon src="https://cdn.lordicon.com/itmmouju.json" trigger="loop-on-hover"
                                        colors="primary:#ffffff,secondary:#07a889" style="width:50px;height:50px">
                                    </lord-icon>
                                </div>
                                <span>PRODUCTOS</span>
                            </div>
                        </a>
                    </li>
                @endcan
                @can('3. Tab Ventas')
                    <li class="">
                        <a href="{{ route('pos') }}" class="menu-toggle" data-active='false'>
                            <div class="base-menu">
                                <div class="base-icons">
                                    <lord-icon src="https://assets2.lottiefiles.com/packages/lf20_igjaezoi.json"
                                        trigger="loop-on-hover" colors="primary:#ffffff,secondary:#08a88a"
                                        style="width:50px;height:50px">
                                    </lord-icon>
                                </div>
                                <span>VENTAS</span>
                            </div>
                        </a>
                    </li>
                @endcan
                {{-- @can('11. Compras') --}}
                <li class="">
                    <a href="{{ route('buy') }}" class="menu-toggle" data-active='false'>
                        <div class="base-menu">
                            <div class="base-icons">
                                <lord-icon src="https://assets7.lottiefiles.com/packages/lf20_tbn1qghe.json"
                                    trigger="loop-on-hover" colors="primary:#ffffff,secondary:#08a88a"
                                    style="width:50px;height:50px">
                                </lord-icon>
                            </div>
                            <span>COMPRAS</span>
                        </div>
                    </a>
                </li>
                {{-- @endcan --}}
                {{-- @can('4. Tab Rol')
                    <li class="">
                        <a href="{{ route('roles') }}" class="menu-toggle" data-active='false'>
                            <div class="base-menu">
                                <div class="base-icons">
                                    <lord-icon src="https://assets7.lottiefiles.com/packages/lf20_z2itipsu.json"
                                        trigger="loop-on-hover" colors="primary:#ffffff,secondary:#08a88a"
                                        style="width:70px;height:70px">
                                    </lord-icon>
                                </div>
                                <span>ROLES</span>
                            </div>
                        </a>
                    </li>
                @endcan
                @can('5. Tab Permiso')
                    <li class="">
                        <a href="{{ route('permisos') }}" class="menu-toggle" data-active='false'>
                            <div class="base-menu">
                                <div class="base-icons">
                                    <lord-icon src="https://assets8.lottiefiles.com/packages/lf20_n7s94b5h.json"
                                        trigger="loop-on-hover" colors="primary:#ffffff,secondary:#08a88a"
                                        style="width:70px;height:70px">
                                    </lord-icon>
                                </div>
                                <span>PERMISOS</span>
                            </div>
                        </a>
                    </li>
                @endcan --}}
                {{-- @can('6. Tab Asignar')
                    <li class="">
                        <a href="{{ route('asignar') }}" class="menu-toggle" data-active='false'>
                            <div class="base-menu">
                                <div class="base-icons">
                                    <lord-icon src="https://assets10.lottiefiles.com/packages/lf20_h4gyvywo.json"
                                        trigger="loop-on-hover" colors="primary:#ffffff,secondary:#08a88a"
                                        style="width:70px;height:70px">
                                    </lord-icon>
                                </div>
                                <span>ASIGNAR</span>
                            </div>
                        </a>
                    </li>
                @endcan --}}
                {{-- @can('7. Usuario')
                    <li class="">
                        <a href="{{ route('users') }}" class="menu-toggle" data-active='false'>
                            <div class="base-menu">
                                <div class="base-icons">
                                    <lord-icon src="https://assets1.lottiefiles.com/packages/lf20_umcyeafh.json"
                                        trigger="loop-on-hover" colors="primary:#07a889,secondary:#ffffff"
                                        style="width:70px;height:70px">
                                    </lord-icon>
                                </div>
                                <span>USUARIOS</span>
                            </div>
                        </a>
                    </li>
                @endcan --}}
                {{-- @can('7. Proveedor') --}}
                {{-- <li class="">
                    <a href="{{ route('providers') }}" class="menu-toggle" data-active='false'>
                        <div class="base-menu">
                            <div class="base-icons">
                                <lord-icon src="https://assets1.lottiefiles.com/packages/lf20_umcyeafh.json"
                                    trigger="loop-on-hover" colors="primary:#07a889,secondary:#ffffff"
                                    style="width:70px;height:70px">
                                </lord-icon>
                            </div>
                            <span>PROVEEDOR</span>
                        </div>
                    </a>
                </li> --}}
                {{-- @endcan --}}
                {{-- @can('8. Tab Moneda')
                    <li class="">
                        <a href="{{ route('coins') }}" class="menu-toggle" data-active='false'>
                            <div class="base-menu">
                                <div class="base-icons">
                                    <lord-icon src="https://assets7.lottiefiles.com/packages/lf20_ltgagxzo.json"
                                        trigger="loop-on-hover" colors="primary:#ffffff,secondary:#08a88a"
                                        style="width:70px;height:70px">
                                    </lord-icon>
                                </div>
                                <span>MONEDAS</span>
                            </div>
                        </a>
                    </li>
                @endcan --}}
                {{-- @can('9. Tab Cierre de Caja')
                    <li class="">
                        <a href="{{ route('cashout') }}" class="menu-toggle" data-active='false'>
                            <div class="base-menu">
                                <div class="base-icons">
                                    <lord-icon src="https://assets9.lottiefiles.com/packages/lf20_a017jgau.json"
                                        trigger="loop-on-hover" colors="primary:#ffffff,secondary:#08a88a"
                                        style="width:70px;height:70px">
                                    </lord-icon>
                                </div>
                                <span>CIERRE DE CAJA</span>
                            </div>
                        </a>
                    </li>
                @endcan --}}
                {{-- @can('10. Reporte')
                    <li class="">
                        <a href="{{ route('reports') }}" class="menu-toggle" data-active='false'>
                            <div class="base-menu">
                                <div class="base-icons">
                                    <lord-icon src="https://assets5.lottiefiles.com/packages/lf20_g4rf74et.json"
                                        trigger="loop-on-hover" colors="primary:#ffffff,secondary:#08a88a"
                                        style="width:70px;height:70px">
                                    </lord-icon>
                                </div>
                                <span>REPORTES VENTAS</span>
                            </div>
                        </a>
                    </li>
                @endcan
                <li class="">
                    <a href="{{ route('reporteCompras') }}" class="menu-toggle" data-active='false'>
                        <div class="base-menu">
                            <div class="base-icons">
                                <lord-icon src="https://assets5.lottiefiles.com/packages/lf20_g4rf74et.json"
                                    trigger="loop-on-hover" colors="primary:#ffffff,secondary:#08a88a"
                                    style="width:70px;height:70px">
                                </lord-icon>
                            </div>
                            <span>REPORTE COMPRAS</span>
                        </div>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('logs') }}" class="menu-toggle" data-active='false'>
                        <div class="base-menu">
                            <div class="base-icons">
                                <lord-icon src="https://assets5.lottiefiles.com/packages/lf20_g4rf74et.json"
                                    trigger="loop-on-hover" colors="primary:#ffffff,secondary:#08a88a"
                                    style="width:70px;height:70px">
                                </lord-icon>
                            </div>
                            <span>REGISTROS</span>
                        </div>
                    </a>
                </li> --}}
                {{-- Reportes --}}
                <li class="">
                    <a class="menu-toggle" data-active='false' data-toggle="collapse" href="#collapseReportes"
                        role="button" aria-expanded="false" aria-controls="collapseReportes">
                        <div class="base-menu">
                            <div class="base-icons">
                                <lord-icon src="https://assets10.lottiefiles.com/packages/lf20_h4gyvywo.json"
                                    trigger="loop-on-hover"
                                    colors="primary:#ffffff,secondary:#08a88a"style="width:50px;height:50px">
                                </lord-icon>
                            </div>
                            <span>REPORTES</span>
                        </div>
                    </a>
                    <div class="collapse menu-toggle" id="collapseReportes">
                        @can('9. Tab Cierre de Caja')
                            <a href="{{ route('cashout') }}" class="" data-active='false'>
                                <p class="text-white text-center">Cierre de Caja</p>
                            </a>
                        @endcan
                        @can('10. Reporte')
                            <a href="{{ route('reports') }}" class="" data-active='false'>
                                <p class="text-white text-center">Reporte de Ventas</p>
                            </a>
                        @endcan
                        <a href="{{ route('reporteCompras') }}" class="" data-active='false'>
                            <p class="text-white text-center">Reporte Compra</p>
                        </a>

                        <a href="{{ route('logs') }}" class="" data-active='false'>
                            <p class="text-white text-center">Logs</p>
                        </a>
                </li>
                {{-- Configuracio --}}
                <li class="">
                    <a class="menu-toggle" data-active='false' data-toggle="collapse" href="#collapseConfiguracion"
                        role="button" aria-expanded="false" aria-controls="collapseConfiguracion">
                        <div class="base-menu">
                            <div class="base-icons">
                                <lord-icon src="https://assets10.lottiefiles.com/packages/lf20_h4gyvywo.json"
                                    trigger="loop-on-hover"
                                    colors="primary:#ffffff,secondary:#08a88a"style="width:50px;height:50px">
                                </lord-icon>
                            </div>
                            <span>CONFIGURACION</span>
                        </div>
                    </a>
                    <div class="collapse" id="collapseConfiguracion">
                        <a href="{{ route('users') }}" class=" text-center" data-active='false'>
                            <p class="text-white text-center">Usuarios</p>
                        </a>
                        <a href="{{ route('providers') }}" class="" data-active='false'>
                            <p class="text-white text-center">Proveedor</p>
                        </a>
                        @can('4. Tab Rol')
                            <a href="{{ route('roles') }}" class="" data-active='false'>
                                <p class="text-white text-center">Roles</p>
                            </a>
                        @endcan
                        <a href="{{ route('asignar') }}" class="" data-active='false'>
                            <p class="text-white text-center">Permiso Rol</p>
                        </a>
                        @can('5. Tab Permiso')
                            {{--  --}}
                            <a href="{{ route('permisos') }}" class="" data-active='false'>
                                <p class="text-white text-center">Permiso</p>
                            </a>
                        @endcan
                        @can('8. Tab Moneda')
                            <a href="{{ route('coins') }}" class="" data-active='false'>
                                <p class="text-white text-center">Moneda</p>
                            </a>
                        @endcan
                    </div>
                </li>

            </ul>
        </nav>
    </div>
    <div id="compact_submenuSidebar" class="submenu-sidebar" style="display: none!important">
    </div>
@endauth

<script src="https://cdn.lordicon.com/lusqsztk.js"></script>
