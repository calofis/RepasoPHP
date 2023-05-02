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
                <a href="/formulario" class="nav-link <?php echo isset($seccion) && $seccion === 'formulario' ? 'active' : ''; ?>">
                  <i class="fas fa-parachute-box nav-icon"></i>
                  <p>Formulario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/factorial" class="nav-link <?php echo isset($seccion) && $seccion === 'factorial' ? 'active' : ''; ?>">
                  <i class="fas fa-cubes nav-icon"></i>
                  <p>Factorial</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/multiplicar" class="nav-link <?php echo isset($seccion) && $seccion === 'multiplicar' ? 'active' : ''; ?>">
                  <i class="fas fa-cube nav-icon"></i>
                  <p>Multiplicar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/primos" class="nav-link <?php echo isset($seccion) && $seccion === 'primos' ? 'active' : ''; ?>">
                  <i class="fas fa-cube nav-icon"></i>
                  <p>Primos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/mayorMenor" class="nav-link <?php echo isset($seccion) && $seccion === 'mayorMenor' ? 'active' : ''; ?>">
                  <i class="fas fa-cube nav-icon"></i>
                  <p>Mayor Menor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/ordenar" class="nav-link <?php echo isset($seccion) && $seccion === 'ordenar' ? 'active' : ''; ?>">
                  <i class="fas fa-cube nav-icon"></i>
                  <p>Ordenar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/usuarios" class="nav-link <?php echo isset($seccion) && $seccion === 'todos_usuarios' ? 'active' : ''; ?>">
                  <i class="fas fa-cube nav-icon"></i>
                  <p>Todos los usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/salarios" class="nav-link <?php echo isset($seccion) && $seccion === 'todos_usuarios_ordeby' ? 'active' : ''; ?>">
                  <i class="fas fa-cube nav-icon"></i>
                  <p>Todos los usuarios ordenados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/usuariosSTD" class="nav-link <?php echo isset($seccion) && $seccion === 'todos_usuariosSTD' ? 'active' : ''; ?>">
                  <i class="fas fa-cube nav-icon"></i>
                  <p>Todos los usuarios Standart</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/carlos" class="nav-link <?php echo isset($seccion) && $seccion === 'todos_carlos' ? 'active' : ''; ?>">
                  <i class="fas fa-cube nav-icon"></i>
                  <p>Todos los usuarios llamados Carlos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/roles" class="nav-link <?php echo isset($seccion) && $seccion === 'roles' ? 'active' : ''; ?>">
                  <i class="fas fa-cube nav-icon"></i>
                  <p>Filtros</p>
                </a>
              </li>
            </ul>
          </li>                   
        </ul>
      </nav>
      <!-- /.sidebar-menu -->