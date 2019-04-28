@extends('master.app')
@section('title') Rekap Peserta @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="/AdminLTE/plugins/datatables/dataTables.bootstrap4.css">
{{-- export --}}
<link rel="stylesheet" href="/css/buttons.dataTables.min.css">

@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Rekap Peserta</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Peserta</li>
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
          <h3 class="card-title">Data Rekap Peserta
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if($all->count())
          <table id="rekap-peserta" class="table table-bordered table-striped">
            <thead style="text-align: center">
              <tr>
                <th width="5%">No</th>
                <th>Per Tanggal</th>
                <th>Jumlah Jam</th>
                <th>Jumlah Peserta</th>
                <th>Jumlah Kegiatan</th>
                <th>Jumlah Pegawai Mengikuti Training</th>
                <th>Jumlah Pegawai Mengikuti GIAT</th>
                <th>Jumlah Pegawai Mengikuti Juara</th>
                <th>Total Pegawai</th>
                <th>Rata-rata Jam/pegawai</th>
                <th>Rata-rata Hari/pegawai</th>
              </tr>
            </thead>
            <tbody>
              @foreach($rekap as $r)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$r['per_tanggal']}}</td>
                <td>{{$r['jmlh_jam']}}</td>
                <td>{{$r['jmlh_peserta']}}</td>
                <td>{{$r['jmlh_kegiatan']}}</td>
                <td>{{$r['jmlh_pegawai_training']}}</td>
                <td>{{$r['jmlh_peserta_giat']}}</td>
                <td>{{$r['jmlh_peserta_juara']}}</td>
                <td>{{$r['total_pegawai']}}</td>
                <td>{{$r['jam_per_pegawai']}}</td>
                <td>{{$r['hari_per_pegawai']}}</td>
              </tr>
              @endforeach
              <tr>
                <td></td>
                <td><b>TOTAL</b></td>
                <td>{{$total['jmlh_jam']}}</td>
                <td>{{$total['jmlh_peserta']}}</td>
                <td>{{$total['jmlh_kegiatan']}}</td>
                <td>{{$total['jmlh_pegawai_training']}}</td>
                <td>{{$total['jmlh_peserta_giat']}}</td>
                <td>{{$total['jmlh_peserta_juara']}}</td>
                <td>{{$total['total_pegawai']}}</td>
                <td>{{$total['jam_per_pegawai']}}</td>
                <td>{{$total['hari_per_pegawai']}}</td>
              </tr>
          </table>
          @else
          <div class="alert alert-warning">
            <i class="fa fa-exclamation-triangle"></i> Tidak ada data.
          </div>
          @endif
        </div>
        <!-- /.card-body -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
@section('script')
<!-- DataTables -->
<script src="/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="/AdminLTE/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
{{-- export table --}}
<script src="/js/dataTables.buttons.min.js"></script>
<script src="/js/jszip.min.js"></script>
<script src="/js/buttons.html5.min.js"></script>
<script src="/js/vfs_fonts.js"></script>
<script>
   $(document).ready(function() {
    $('#rekap-peserta').dataTable({
      dom: 'Blfrtip',
      buttons: [
            {
              extend: 'excel',
              text: '<span class="fa fa-file-excel-o"></span> Excel Export',
              exportOptions: {
                  modifier: {
                      search: 'applied',
                      order: 'applied'
                  }
              }
            }
        ],
      scrollX: 'true'
    });
  });
</script>

@endsection

