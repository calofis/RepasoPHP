<!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Inicio
              </p>
            </a>
          </li> 
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Panel de control
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/seccion1" class="nav-link <?php echo isset($seccion) && $seccion === 'seccion1' ? 'active' : ''; ?>">
                  <i class="fas fa-parachute-box nav-icon"></i>
                  <p>Sección 1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/seccion2" class="nav-link <?php echo isset($seccion) && $seccion === 'seccion2' ? 'active' : ''; ?>">
                  <i class="fas fa-cubes nav-icon"></i>
                  <p>Sección 2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/seccion3" class="nav-link <?php echo isset($seccion) && $seccion === 'seccion3' ? 'active' : ''; ?>">
                  <i class="fas fa-cube nav-icon"></i>
                  <p>Sección 3</p>
                </a>
              </li>
            </ul>
          </li>                   
        </ul>
      </nav>
      <!-- /.sidebar-menu -->