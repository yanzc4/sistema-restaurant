<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="assets/img/boomerang-logo.png" alt="logo">
            </span>

            <div class="text logo-text">
                <span class="name">Boomerang</span>
                <span class="profession"><?php echo $nombre, " ", $apellido ?></span>
            </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">

            <li class="search-box">
                <i class='bx bx-search icon'></i>
                <input type="text" placeholder="Search...">
            </li>

            <ul class="menu-links">
                <li class="nav-link">
                    <a href="view/dashboardempleado.php" target="myFrame">
                        <i class='bx bx-home-alt icon'></i>
                        <span class="text nav-text">Inicio</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="ventas.php" target="myFrame">
                        <i class='bx bx-bowl-rice icon'></i>
                        <span class="text nav-text">Ventas</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="view/reportesempleado.php" target="myFrame">
                        <i class='bx bx-pie-chart-alt icon'></i>
                        <span class="text nav-text">Reportes</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="view/listapedidos.php" target="myFrame">
                        <i class='bx bx-dish icon'></i>
                        <span class="text nav-text">Ordenes</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="view/perfil.php" target="myFrame">
                        <i class='bx bx-user icon'></i>
                        <span class="text nav-text">Perfil</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="bottom-content">
            <li class="">
                <a href="backend/salir.php">
                    <i class='bx bx-log-out icon'></i>
                    <span class="text nav-text">Salir</span>
                </a>
            </li>

            <li class="mode">
                <div class="sun-moon">
                    <i class='bx bx-moon icon moon'></i>
                    <i class='bx bx-sun icon sun'></i>
                </div>
                <span class="mode-text text">Dark mode</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>

        </div>
    </div>

</nav>