  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <h4 style="padding-top: 7px"> Sistem Informasi Training Artajasa</h4>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="/index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>
    <ul class="navbar-nav ml-auto">
    <!-- logout Menu -->
    <li class="nav-item">
      <form id="logout" action="{{ route('logout') }}" method="POST">
        {{@csrf_field()}}
        <button class="btn btn-block btn-outline-danger" type="submit" form="logout"><i class="fa fa-power-off"></i></button>
      </form>
    </li>
  </ul>
  </nav>
  <!-- /.navbar -->
