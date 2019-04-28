@extends('master.app')
@section('title') Edit Data Departemen @endsection
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
            <h1 class="m-0 text-dark">Departemen</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="/departemen">Departemen</a></li>
              <li class="breadcrumb-item active">Edit Departemen</li>
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
          <h3 class="card-title">Edit Data Departemen</h3>
        </div>
        <!-- /.card-header -->
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <!-- form start -->
        <form role="form" action="../update/{{$dept->id_departemen}}" method="post">
          {{csrf_field()}}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <form role="form">
          <div class="card-body">
            <div class="form-group">
              <label for="id_departemen">ID Departemen</label>
              <input name="id_departemen" type="text" class="form-control" id="id_departemen" value="{{$dept->id_departemen}}" required>
              <label for="id_departemen">ID</label>
              <input name="id_departemen" type="text" class="form-control" id="id_departemen" placeholder="Masukkan ID Departemen" required>
            </div>
            <div class="form-group">
              <label for="nama_departemen">Nama Departemen</label>
              <input name="nama_departemen" type="text" class="form-control" id="nama_departemen" value="{{$dept->nama_departemen}}" required>
              <label for="nama_departemen">Nama</label>
              <input name="nama_departemen" type="text" class="form-control" id="nama_departemen" placeholder="Masukkan Nama Departemen" required>
            </div>
            <div class="form-group">
              <label for="id_divisi">Divisi</label>
              <select name="id_divisi" class="form-control select2" style="width: 100%;">
                <option value="{{$dept->id_divisi}}" selected>{{$dept->id_divisi}}</option>
                @foreach($divisi as $d)
                  <option value="{{$d->id_divisi}}">{{$d->id_divisi}}</option>
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

