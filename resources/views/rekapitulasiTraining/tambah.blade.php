@extends('master.app')
@section('title') Tambah Rekapitulasi Training @endsection
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
            <h1 class="m-0 text-dark">Rekapitulasi Training</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="/rekapitulasiTraining">Rekapitulasi Training</a></li>
              <li class="breadcrumb-item active">Tambah Rekapitulasi Training</li>
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
          <h3 class="card-title">Tambah Rekapitulasi Training</h3>
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
        <form role="form" action="store" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="card-body">
            <div class="form-group">
              <label for="id_training">Nama Training</label>
              <select name="id_training" class="form-control select2" style="width: 100%;">
                @foreach($training as $t)
                <option value="{{$t->id_training}}">{{$t->nama_training}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="nik_pegawai">Peserta</label>
              <select name="nik_pegawai[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                @foreach($pegawai as $p)
                <option value="{{$p->nik_pegawai}}">{{$p->nama_pegawai}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="justifikasi">Justifikasi</label>
              <input name="justifikasi" type="text" class="form-control" id="justifikasi" placeholder="Masukkan Justifikasi" required>
            </div>
            <div class="form-group">
              <label> <i class="fa fa-calendar"></i> Tanggal:</label>
              <input name="tanggal_training" type="text" class="date form-control" id="tanggal_training" placeholder="Masukkan Tanggal Training" required>
              <!-- /.input group -->
            </div>
            <div class="form-group">
              <label><i class="fa fa-clock-o"></i> Jumlah Jam:</label>
              <input name="jumlah_jam_training" type="number" class="form-control" placeholder="Masukkan Jumlah Jam Training" required>
            </div>
            <!-- /.form group -->
            <div class="form-group">
              <label for="harga_training">Harga Training/peserta</label>
              <input name="harga_training" type="number" class="form-control" id="harga_training" placeholder="Masukkan Harga Training per Peserta" required>
            </div>
            <div class="form-group">
              <label for="invoice_training">Invoice/peserta</label>
              <input name="invoice_training" type="number" class="form-control" id="invoice_training" placeholder="Masukkan Invoice Training per Peserta">
            </div>
            <div class="form-group">
              <label for="biaya_lain">Biaya Lain (total)</label>
              <input name="biaya_lain" type="number" class="form-control" id="biaya_lain" placeholder="Masukkan Biaya Lain (total)">
            </div>
            <div class="form-group">
              <label for="keterangan_lain">Keterangan Lain</label>
              <input name="keterangan_lain" type="text" class="form-control" id="keterangan_lain" placeholder="Masukkan Keterangan Lain">
            </div>
            <div class="col-sm-6 form-group" style="float: left">
              <label for="fpt_file">FPT Approved</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="fpt_file" name="fpt_file">
                  <label class="custom-file-label" for="fpt_file">Choose file</label>
                </div>
              </div>
            </div>
            <div class="col-sm-6 form-group" style="float: left">
              <label for="pendaftaran">Pendaftaran</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="pendaftaran" name="pendaftaran_file">
                  <label class="custom-file-label" for="pendaftaran">Choose file</label>
                </div>
              </div>
            </div>
            <div class="col-sm-6 form-group" style="float: left">
              <label for="undangan_file">Undangan</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="undangan_file" name="undangan_file">
                  <label class="custom-file-label" for="undangan_file">Choose file</label>
                </div>
              </div>
            </div>
            <div class="col-sm-6 form-group" style="float: left">
              <label for="absensi_file">Absensi</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="absensi_file" name="absensi_file">
                  <label class="custom-file-label" for="absensi_file">Choose file</label>
                </div>
              </div>
            </div>
            <div class="col-sm-6 form-group" style="float: left">
              <label for="sertifikat_file">Sertifikat</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="sertifikat_file" name="sertifikat_file">
                  <label class="custom-file-label" for="sertifikat_file">Choose file</label>
                </div>
              </div>
            </div>
            <div class="col-sm-6 form-group" style="float: left">
              <label for="invoice_file">File Invoice</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="invoice_file" name="invoice_file">
                  <label class="custom-file-label" for="invoice_file">Choose file</label>
                </div>
              </div>
            </div>
            <div class="col-sm-6 form-group" style="float: left">
              <label for="eval_file">Evaluasi</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="eval_file" name="eval_file">
                  <label class="custom-file-label" for="eval_file">Choose file</label>
                </div>
              </div>
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
<!-- Select2 -->
<script src="/AdminLTE/plugins/select2/select2.full.min.js"></script>
<script>
  $(document).ready(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('.date').datepicker({
      multidate: true,
      format: 'yyyy-mm-dd'
    });
  })
</script>
@endsection

