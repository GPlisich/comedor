<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

        <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-utensils "></i>
            <p>
                Menu
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/menu/showMenu" class="nav-link">
                    <i class="nav-icon fa fa-plus"></i>
                    <p>
                        Crear o Editar Menu
                        <span class="right badge badge-danger">New</span>
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/menu/showTickets" class="nav-link">
                    <i class="nav-icon fa fa-clipboard-list"></i>
                    <p>Pedidos por semana</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/menu/showUserMenu" class="nav-link">
                    <i class="nav-icon fa fa-address-card"></i>
                    <p>Menu Usuario</p>
                    </a>
                </li>
                
            </ul>
        </li>
        

        @if(session()->exists('userLogin') && session('userLogin')==true)
            <li class="nav-item">
                <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                    <i class="nav-icon fa fa-share"></i>
                    <p>Logout</p>
                </a>
                
            </li>
        @endif

        <form id="logout-form" action="/login/logout" method="POST" class="d-none">
            @csrf
        </form>
        

    </ul>
</nav>