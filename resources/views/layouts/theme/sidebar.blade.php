<div class="sidebar-wrapper sidebar-theme">
    <nav id='compactSidebar'>

        <ul class="menu-categories">
            @can('1. Tab Categoria')
                <li class="active">
                    <a href="{{ route('categorias') }}" class="menu-toggle" data-active='true'>
                        <div class="base-menu">
                            <div class="base-icons">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-grid">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-codepen">
                                    <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon>
                                    <line x1="12" y1="22" x2="12" y2="15.5"></line>
                                    <polyline points="22 8.5 12 15.5 2 8.5"></polyline>
                                    <polyline points="2 15.5 12 8.5 22 15.5"></polyline>
                                    <line x1="12" y1="2" x2="12" y2="8.5"></line>
                                </svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-tag">
                                    <path
                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                    </path>
                                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                </svg>
                            </div>
                            <span>VENTAS</span>
                        </div>
                    </a>
                </li>
            @endcan
            @can('4. Tab Rol')
                <li class="">
                    <a href="{{ route('roles') }}" class="menu-toggle" data-active='false'>
                        <div class="base-menu">
                            <div class="base-icons">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-key">
                                    <path
                                        d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4">
                                    </path>
                                </svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-check-square">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <span>USUARIOS</span>
                        </div>
                    </a>
                </li>
            @endcan
            @can('8. Tab Moneda')
                <li class="">
                    <a href="{{ route('coins') }}" class="menu-toggle" data-active='false'>
                        <div class="base-menu">
                            <div class="base-icons">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-dollar-sign">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-hard-drive">
                                    <line x1="22" y1="12" x2="2" y2="12"></line>
                                    <path
                                        d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                    </path>
                                    <line x1="6" y1="16" x2="6.01" y2="16"></line>
                                    <line x1="10" y1="16" x2="10.01" y2="16"></line>
                                </svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-activity">
                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                </svg>
                            </div>
                            <span>REPORTES</span>
                        </div>
                    </a>
                </li>
            @endcan

        </ul>
    </nav>
</div>
<div id="compact_submenuSidebar" class="submenu-sidebar" style="display: none!important">
</div>
