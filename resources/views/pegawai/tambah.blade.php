@extends('master.app')
@section('title') Tambah Data Pegawai @endsection
@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="/AdminLTE/plugins/select2/select2.min.css">
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pegawai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="/pegawai">Pegawai</a></li>
              <li class="breadcrumb-item active">Tambah Pegawai</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Data Pegawai</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <form role="form" action="store" method="post">
        {{csrf_field()}}
          <div class="card-body">
            <div class="form-group">
              <label for="nik_pegawai">NIK Pegawai</label>
              <input name="nik_pegawai" type="number" class="form-control" id="nik_pegawai" placeholder="Masukkan NIK" required>
            </div>
            <div class="form-group">
              <label for="nama_pegawai">Nama Pegawai</label>
              <input name="nama_pegawai" type="text" class="form-control" id="nama_pegawai" placeholder="Masukkan Nama Pegawai" required>
            </div>
            <div class="form-group col-sm-6" style="float: left">
              <label for="tanggal_masuk">Tanggal Masuk</label>
              <input name="tanggal_masuk" type="date" class="form-control" id="tanggal_masuk" placeholder="Masukkan Tanggal Masuk Pegawai">
            </div>
            <div class="form-group col-sm-6" style="float: left">
              <label for="tanggal_keluar">Tanggal Keluar</label>
              <input name="tanggal_keluar" type="date" class="form-control" id="tanggal_keluar" placeholder="Masukkankan Tanggal Keluar Pegawai">
            </div>
            <div class="form-group col-sm-6" style="float: left">
              <label for="id_departemen">Departemen</label>
              <select name="id_departemen" class="form-control select2" style="width: 100%;" required>
                @foreach($departemen as $d)
                <option value="{{$d->id_departemen}}">{{$d->nama_departemen}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-sm-6" style="float: left">
              <label for="id_jabatan">Jabatan</label>
              <select name="id_jabatan" class="form-control select2" style="width: 100%;" required>
                @foreach($jabatan as $j)
                <option value="{{$j->id_jabatan}}">{{$j->nama_jabatan}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('script')
<!-- jQuery -->
<script src="/AdminLTE/plugins/jquery/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<!-- Select2 -->
<script src="/AdminLTE/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
@endsection

