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
                                        colors="primary:#ffffff,secondary:#07a889" style="width:70px;height:70px">
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
                                        colors="primary:#ffffff,secondary:#07a889" style="width:70px;height:70px">
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
                                        style="width:70px;height:70px">
                                    </lord-icon>
                                </div>
                                <span>VENTAS</span>
                            </div>
                        </a>
                    </li>
                @endcan
                {{-- @can('11. Compras') --}}
                <li class="">
                    <a href="{{route('buy')}}" class="menu-toggle" data-active='false'>
                        <div class="base-menu">
                            <div class="base-icons">
                                <lord-icon src="https://assets7.lottiefiles.com/packages/lf20_tbn1qghe.json"
                                    trigger="loop-on-hover" colors="primary:#ffffff,secondary:#08a88a"
                                    style="width:70px;height:70px">
                                </lord-icon>
                            </div>
                            <span>COMPRAS</span>
                        </div>
                    </a>
                </li>
                {{-- @endcan --}}
                @can('4. Tab Rol')
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
                @endcan
                @can('6. Tab Asignar')
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
                @endcan
                @can('7. Usuario')
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
                @endcan
                {{-- @can('7. Usuario') --}}
                    <li class="">
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
                    </li>
                {{-- @endcan --}}
                @can('8. Tab Moneda')
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
                @endcan
                @can('9. Tab Cierre de Caja')
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
                @endcan
                @can('10. Reporte')
                    <li class="">
                        <a href="{{ route('reports') }}" class="menu-toggle" data-active='false'>
                            <div class="base-menu">
                                <div class="base-icons">
                                    <lord-icon src="https://assets5.lottiefiles.com/packages/lf20_g4rf74et.json"
                                        trigger="loop-on-hover" colors="primary:#ffffff,secondary:#08a88a"
                                        style="width:70px;height:70px">
                                    </lord-icon>
                                </div>
                                <span>
                                    <h6>REPORTES</h6>
                                </span>
                            </div>
                        </a>
                    </li>
                @endcan

            </ul>
        </nav>
    </div>
    <div id="compact_submenuSidebar" class="submenu-sidebar" style="display: none!important">
    </div>
@endauth

<script src="https://cdn.lordicon.com/lusqsztk.js"></script>
