<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="/index3" class="brand-link">
      <img src="/AdminLTE/dist/img/logo-artajasa.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-heavy">Artajasa</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/AdminLTE/dist/img/hendry.JPG" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
                <!-- <i class="right fa fa-angle-left"></i> -->
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-id-badge"></i>
              <p>
                Training
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: {{ Request::is('training') ? 'block' : Request::is('rekapitulasiTraining') ? 'block' : 'none'}}">
              <li class="nav-item">
                <a href="/training" class="nav-link {{ Request::is('training') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>List Training</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/rekapitulasiTraining" class="nav-link {{ Request::is('rekapitulasiTraining') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Rekapitulasi Training</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Kepegawaian
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: {{ Request::is('pegawai') ? 'block' : Request::is('jabatan') ? 'block' : Request::is('divisi') ? 'block' : Request::is('departemen') ? 'block' : 'none'}}">
              <li class="nav-item">
                <a href="/pegawai" class="nav-link {{ Request::is('pegawai') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Data pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/jabatan" class="nav-link {{ Request::is('jabatan') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Jabatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/direktorat" class="nav-link {{ Request::is('direktorat') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Direktorat</p>
                </a>
              </li>
              <li class="nav-item {{ Request::is('divisi') ? 'active' : '' }}">
                <a href="/divisi" class="nav-link {{ Request::is('divisi') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Divisi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/departemen" class="nav-link {{ Request::is('departemen') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Departemen</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-empire"></i>
              <p>
                Referensi
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: {{ Request::is('media') ? 'block' : Request::is('topik') ? 'block' : Request::is('penyelenggara') ? 'block' : Request::is('kompetensi') ? 'block' : 'none'}}">
              <li class="nav-item">
                <a href="/media" class="nav-link {{ Request::is('media') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Media</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/topik" class="nav-link {{ Request::is('topik') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Topik</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/penyelenggara" class="nav-link {{ Request::is('penyelenggara') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Penyelenggara</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/kompetensi" class="nav-link {{ Request::is('kompetensi') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Kompetensi</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-money"></i>
              <p>
                Keuangan
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: {{ Request::is('anggaran') ? 'block' : Request::is('rekapbiaya') ? 'block' : 'none'}}">
              <li class="nav-item">
                <a href="/anggaran" class="nav-link {{ Request::is('anggaran') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Anggaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/rekapbiaya" class="nav-link {{ Request::is('rekapbiaya') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Rekap Biaya</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>