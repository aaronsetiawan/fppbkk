@extends('master.app')
@section('title') Edit Training @endsection
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
            <h1 class="m-0 text-dark">List Training</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="/training">List Training</a></li>
              <li class="breadcrumb-item active">Edit List Training</li>
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
          <h3 class="card-title">Edit List Training</h3>
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
        <form role="form" action="../update/{{$train->id_training}}" method="post">
          {{csrf_field()}}
          <div class="card-body">
            <div class="form-group">
              <label>ID</label>
              <input name="id_training" type="number" class="form-control" id="id_training" value="{{$train->id_training}}" disabled>
            </div>
            <div class="form-group">
              <label for="nama_training">Nama Training</label>
              <input name="nama_training" type="text" class="form-control" id="nama_training" value="{{$train->nama_training}}" required>
            </div>
            <div class="form-group col-sm-6" style="float: left">
              <label for="id_media">Media</label>
              <select name="id_media" class="form-control select2" style="width: 100%;">
                <option value="{{$train->id_media}}" selected>{{$train->nama_media}}</option>
                @foreach($media as $m)
                <option value="{{$m->id_media}}">{{$m->nama_media}} ({{$m->kategori_media}})</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-sm-6" style="float: left">
              <label for="id_topik">Topik</label>
              <select name="id_topik" class="form-control select2" style="width: 100%;">
                <option value="{{$train->id_topik}}" selected>{{$train->nama_topik}}</option>
                @foreach($topik as $t)
                <option value="{{$t->id_topik}}">{{$t->nama_topik}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-sm-6" style="float: left">
              <label for="id_kompetensi">Kompetensi</label>
              <select name="id_kompetensi" class="form-control select2" style="width: 100%;">
                <option value="{{$train->id_kompetensi}}" selected>{{$train->nama_kompetensi}}</option>
                @foreach($kompetensi as $k)
                <option value="{{$k->id_kompetensi}}">{{$k->nama_kompetensi}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-sm-6" style="float: left">
              <label for="id_penyelenggara">Penyelenggara</label>
              <select name="id_penyelenggara" class="form-control select2" style="width: 100%;">
                <option value="{{$train->id_penyelenggara}}" selected>{{$train->nama_penyelenggara}}</option>
                @foreach($penyelenggara as $p)
                <option value="{{$p->id_penyelenggara}}">{{$p->nama_penyelenggara}}</option>
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
<script src="/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="/AdminLTE/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
@endsection

