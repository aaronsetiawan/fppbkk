@extends('master.app')
@section('title') Rekap Biaya @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="/AdminLTE/plugins/datatables/dataTables.bootstrap4.css">
<!-- Select2 -->
<link rel="stylesheet" href="/AdminLTE/plugins/select2/select2.min.css">
{{-- yadcf --}}
<link rel="stylesheet" href="/yadcf/jquery.dataTables.yadcf.css">
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
            <h1 class="m-0 text-dark">Rekap Biaya</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Biaya</li>
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
          <h3 class="card-title">Data Rekap Biaya
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
         @if($rekapbiaya->count())
          <table id="rekap-biaya" class="table table-bordered table-striped">
            <thead style="text-align: center">
              <tr>
                <th width="5%">No</th>
                <th>Bulan</th>
                <th>Nama Training</th>
                <th>Media</th>
                <th>Tanggal Training</th>
                <th>Penyelenggara</th>
                <th>Peserta</th>
                <th>Biaya Invoice</th>
              </tr>
            </thead>
            <tbody>
            @foreach($rekapbiaya as $a)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$a->bulan}}</td>
                <td>{{$a->nama_training}}</td>
                <td>{{$a->nama_media}} ({{$a->kategori_media}})</td>
                <td>{{$a->tgl_max}}</td>
                <td>{{$a->nama_penyelenggara}}</td>
                <td><button id="lihat" type="button" class="btn btn-block btn-secondary btn-sm" data-id="{{$a->id_training}}" data-bulan="{{$a->bulan}}">lihat</button></td>
                <td>Rp. {{number_format($a->total,2)}}</td>
              </tr>
              @endforeach
              </tbody>
          </table>
          @else
          <div class="alert alert-warning">
            <i class="fa fa-exclamation-triangle"></i> Tidak ada data.
          </div>
          @endif
          <div>
            <button id="lihat2" type="button" class="btn btn-block btn-secondary btn-sm" style="width: 300px">Jumlah per bulan</button>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Modal lihat peserta -->
<div class="modal fade" id="lihatRekapBiaya" tabindex="-1" role="dialog" aria-labelledby="lihatRekapBiaya" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="lihatPeserta">Lihat Peserta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nama Peserta</th>
            </tr>
          </thead>
          <tbody id=RekapBiayaDetailBody>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal jumlah biaya per bulan -->
<div class="modal fade" id="lihatRekapBiayaBulan" tabindex="-1" role="dialog" aria-labelledby="lihatRekapBiayaBulan" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="lihatJumlah">Rekap Biaya Invoice Bulanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <table class="table table-striped">
          <thead>
            <tr>
              <th colspan="2">Rekap Biaya Invoice Bulanan</th>
            </tr>
          </thead>
          <tbody id=RekapBulanDetailBody>

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<!-- DataTables -->
<script src="/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="/AdminLTE/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="/yadcf/jquery.dataTables.yadcf.js"></script>
<!-- Select2 -->
<script src="/AdminLTE/plugins/select2/select2.full.min.js"></script>
{{-- export table --}}
<script src="/js/dataTables.buttons.min.js"></script>
<script src="/js/jszip.min.js"></script>
<script src="/js/buttons.html5.min.js"></script>
<script src="/js/vfs_fonts.js"></script>
<script src="/js/dataTables.buttons.min.js"></script>
<script src="/js/jszip.min.js"></script>
<script src="/js/buttons.html5.min.js"></script>
<script src="/js/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js
"></script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
<script>
  $(document).ready(function() {
    'use strict';
    $('#rekap-biaya').dataTable({
        "bJQueryUI": true,
        "bStateSave": true,
        "scrollX": true, 
        dom: 'Bfrtip',
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
        ]
    }).yadcf([{
        column_number: 1,
        filter_type: "multi_select",
        select_type: 'select2'
    }, {
        column_number: 2,
        filter_type: "multi_select",
        select_type: 'select2'
    }, {
        column_number: 3,
        filter_type: "multi_select",
        select_type: 'select2'
    }, {
        column_number: 4,
        filter_type: "range_date",
        date_format:  'dd-mm-yy'
    }, {
        column_number: 5,
        filter_type: "multi_select",
        select_type: 'select2'
    }, {
        column_number: 7,
        filter_type: "range_number"
    }]);
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
  
$(document).ready(function() { 
  $(document).on('click','#lihat',function(e) {
    jQuery.noConflict();
    // $('#lihatDepartemen').modal('show');
    $.ajaxSetup({
        headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
    })
    e.preventDefault(e);
    var triggerid = $(this).data('id');
    var bulanjs = $(this).data('bulan');
    var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
    // console.log(d);
    $.ajax({
      type: 'get',
      url: '/rekapbiaya/show/'+ triggerid,
      dataType: 'json',
      success: function(message) {
        // console.log(message)
          jQuery.noConflict();
          document.getElementById('RekapBiayaDetailBody').innerHTML = '';
          var tableAppend = '';
          for(var i = 0; i < message.data.length; i++) {
            var d = new Date(message.data[i]['tgl_max']);
            var n = monthNames[d.getMonth()];
            if (i == 0){
              if(bulanjs == n && triggerid == message.data[i]['id_training']){
                tableAppend += '<tr><td>' + message.data[i]['nama_pegawai'] + '</td></tr>';  
              }
            }
            else if(i>0){
              if(bulanjs == n && triggerid == message.data[i]['id_training'] && message.data[i-1]['id_rekapitulasi_training'] != message.data[i]['id_rekapitulasi_training']){
              // console.log(message.data[i]);
              // if(message.data[i]['fg'] == bulanjs)
              tableAppend += '<tr><td>' + message.data[i]['nama_pegawai'] + '</td></tr>';
            }
          }
        }
          $('#RekapBiayaDetailBody').append(tableAppend);
          $('#lihatRekapBiaya').modal('show');
      }
    });
  });
});
</script>

<script type="text/javascript">
  
$(document).ready(function() { 
  $(document).on('click','#lihat2',function(e) {
    jQuery.noConflict();
    // $('#lihatDepartemen').modal('show');
    $.ajaxSetup({
        headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
    })
    e.preventDefault(e);
    var triggerid2 = $(this).data('id');
    $.ajax({
      type: 'get',
      url: '/rekapbiaya/showrekapbulan/',
      dataType: 'json',
      success: function(message) {
        // console.log(message)
          jQuery.noConflict();
          document.getElementById('RekapBulanDetailBody').innerHTML = '';
          var tableAppend = '';
          // console.log('jalan');
          for(var i = 0; i < message.data.length; i++) { 
              console.log(message.data[i]);
              tableAppend += '<tr><td>' + message.data[i]['bulanrekap'] + '</td> + <td>' + 'Rp. ' + message.data[i]['total'] + '</td> </tr>';
        }
          $('#RekapBulanDetailBody').append(tableAppend);
          $('#lihatRekapBiayaBulan').modal('show');
      }
    });
  });
});
</script>
@endsection

