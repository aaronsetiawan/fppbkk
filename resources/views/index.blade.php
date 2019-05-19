@extends('master.app')
@section('title') Dashboard @endsection
@section('css')
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/AdminLTE/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-6 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="col-sm-12">
        <div class="card-body" style="padding-top: 3px">
          <div class="box box-default">
            <div class="box-header with-border">
              <h4 class="box-title"><i class="fa fa-bullhorn"></i> Jangan Lupa !!!</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if($rekapalert->count())
              @foreach($rekapalert as $r)
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="fa fa-exclamation-triangle"></i><b>   Alert!</b></h5>
                <h6>Training <b>{{$r->nama_training}}</b> akan berlangsung pada tanggal <b>{{$r->t}}</b> (Tahun-Bulan-Tanggal).</h6>
              </div>
              @endforeach
            @endif
            </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-sm-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <div class="card card-danger card-outline">
                <div class="card-header">
                  <h3 class="card-title">Jumlah Jam</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="pieChart" style="height:250px"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
        <!-- DONUT CHART -->
        <div class="col-sm-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <div class="card card-danger card-outline">
                <div class="card-header">
                  <h3 class="card-title">Jumlah Peserta</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="pieChart2" style="height:250px"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </section>
      <!-- /.Left col -->

      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-6 connectedSortable">
        <!-- Map card -->
        <div class="col-sm-12">
          <!-- Info Boxes Style 2 -->
          <div class="info-box mb-3 bg-warning">
            <span class="info-box-icon"><i class="fa fa-tag"></i></span>

            <div class="info-box-content">
              <b><span class="info-box-text" style="font-size: 21px">Rata-rata training pegawai dari 1 Januari 2019</span></b>
              <hr>
              <span class="info-box-number"> <h6><b>{{$jamperpegawai}}</b>  jam/pegawai</h6></span>
              <span class="info-box-number"> <h6><b>{{$hariperpegawai}}</b>  hari/pegawai</h6></span>
            </div>
            <!-- /.info-box-content -->
          </div>

          <!-- BAR CHART -->
          <div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">Jumlah Pegawai Berpartisipasi</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
          <!-- @if($toptrainee->count()) -->
            <div class="card-header">
              <h3 class="card-title">Lima Besar Peserta Training</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-widget="remove">
                  <i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                <li class="item">
                  <div class="product-img">
                    No
                  </div>
                  <div class="product-info">
                    <span class="product-description">
                      Nama Pegawai
                      <span class="float-right">Total Training</span></a>
                    </span>
                  </div>
                @foreach($toptrainee as $t)
                  <div class="product-img">
                    {{$loop->iteration}}
                  </div>
                  <div class="product-info">
                    <span class="product-description">
                      {{$t->nama_pegawai}}
                      <span class="float-right">{{$t->total_training}}</span></a>
                    </span>
                  </div>
                @endforeach
                <!-- /.item -->
              </ul>
            </div>
          <!--   @endif -->
            </div>
            <!-- /.card-body -->
          
          <!-- DONUT CHART -->
          <div class="card card-danger card-outline">
            <div class="card-header">
              <h3 class="card-title">Jumlah Kegiatan</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="pieChart3" style="height:250px"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </section>

      <!-- /.col -->
      <section class="col-lg-12 connectedSortable ui-sorta">
        <!-- <div class="row"> -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Report Rekap Biaya</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6" >
                   

                    <div class="progress-group">
                      A. Total Harga Training
                      <span class="float-right"><b>Rp. {{number_format($total_harga,2)}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      B. Total Invoice
                      <span class="float-right"><b>Rp. {{number_format($total_invoice,2)}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 100%"></div>
                      </div>
                    </div>
                    
                    <div style="padding-left: 40px">
                    <div class="progress-group">
                      Inhouse
                      <span class="float-right">Rp. {{number_format($total_invoice_inhouse,2)}}</span>
                  
                        
                    </div>

                    <div class="progress-group">
                      Publik
                      <span class="float-right">Rp. {{$total_invoice_publik}}</span>
                      
                    </div>
                    </div>
                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">C. Total Biaya Lain</span>
                      <span class="float-right"><b>Rp. {{number_format($total_biaya_lain,2)}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 100%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      D. Anggaran 2018
                      <span class="float-right"><b>Rp. {{number_format($anggaran[0]->jumlah_anggaran,2)}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 100%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>

                  <div class="col-md-6" style="padding-top: 50px">
                  <div class="row">
                  <div class="col-md-6">
                    <div class="description-block border-right">
                      <!-- <span class="description-percentage text-success"><i class="fa fa-caret-up"></i> 17%</span> -->
                      <h5 class="description-header">Rp. {{number_format($selisih,2)}}</h5>
                      <span class="description-text">SELISIH (A-B)</span>
                    </div>
        
                  </div>

                   <div class="col-md-6">
                    <div class="description-block">
                      <!-- <span class="description-percentage text-warning"><i class="fa fa-caret-left"></i> 0%</span> -->
                      <h5 class="description-header">Rp. {{number_format($total_terpakai,2)}}</h5>
                      <span class="description-text">Total Terpakai (B+C)</span>
                    </div>
                  </div>
                  </div>
                  <!-- /.col -->
                  <div class="row">
                  <div class="col-md-6">
                    <div class="description-block border-right">
                      <!-- <span class="description-percentage text-success"><i class="fa fa-caret-up"></i> 20%</span> -->
                      <h5 class="description-header">Rp. {{number_format($real_sisa_dana,2)}}</h5>
                      <span class="description-text">Real Sisa Dana (D-B-C)</span>
                    </div>
                    <!-- /.description-block -->
                  </div>

                  <div class="col-md-6">
                    <div class="description-block">
                      <!-- <span class="description-percentage text-danger"><i class="fa fa-caret-down"></i> 18%</span> -->
                      <h5 class="description-header">{{$utilisasi}} %</h5>
                      <span class="description-text">Utilisasi Dana</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  </div>
                  </div>
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- </div> -->
      </section>
      <!-- right col -->
    </div>
  </div>
@endsection

@section('script')
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = document.getElementById('pieChart').getContext('2d')
    // var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChartCanvas2 = document.getElementById('pieChart2').getContext('2d')
    var pieChartCanvas3 = document.getElementById('pieChart3').getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var pieChart2       = new Chart(pieChartCanvas2)
    var pieChart3       = new Chart(pieChartCanvas3)
    var jamArray = []
    var topikArray = []
    var pesertaArray = []
    var topik2Array = []
    var kegiatanArray = []
    var topik3Array = []




    @forelse($jumlahjam as $j)
    jamArray.push("{{$j['jumlahjam']}}");
    topikArray.push("{{$j['topik']}}");
    @empty
    @endforelse

    @forelse($jumlahpeserta as $k)
    pesertaArray.push("{{$k['jumlahpeserta']}}");
    topik2Array.push("{{$k['topik']}}");
    @empty
    @endforelse

    @forelse($jumlahkegiatan as $l)
    kegiatanArray.push("{{$l->jumlahkegiatan1}}");
    topik3Array.push("{{$l->topik}}");
    @empty
    @endforelse

    var pieData   =  []

    function getRandomColor() {
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }


    function getDataset(index, data) { 
      return { 
          value    : data,
          color    : getRandomColor(),
          label    : topikArray[index],
          labelColor : '#000000',
          labelFontSize : '16'
          // highlight: '#f56954'
      }; 
    }

    jamArray.forEach(function (a, i) { 
      pieData.push(getDataset(i,JSON.parse(a))); 
    });

    var pieData2        = []

    function getRandomColor() {
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }


    function getDataset(index, data) { 
      return { 
          value    : data,
          color    : getRandomColor(),
          // highlight: '#f56954',
          label    : topikArray[index],
          labelColor : '#000000',
          labelFontSize : '16'
      }; 
    }


    pesertaArray.forEach(function (a, i) { 
      pieData2.push(getDataset(i,JSON.parse(a))); 
    });

    var pieData3        = []

    function getRandomColor() {
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }


    function getDataset(index, data3) { 
      return { 
          value    : data3,
          color    : getRandomColor(),
          // highlight: '#f56954',
          label    : topikArray[index],
          labelColor : '#000000',
          labelFontSize : '16'
      }; 
    }


    kegiatanArray.forEach(function (a, i) { 
      pieData3.push(getDataset(i,JSON.parse(a))); 
    });

    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
      tooltipEvents: [],
      showTooltips: true,
        onAnimationComplete: function() {
            this.showTooltip(this.segments, true);
        },
      tooltipTemplate: "<%= label %>:<%= value %>"
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieOptions.datasetFill = true
    // pieChart.fillText("%");
    pieChart.Doughnut(pieData, pieOptions)
    pieChart2.Doughnut(pieData2, pieOptions)
    pieChart3.Doughnut(pieData3, pieOptions)

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = document.getElementById('barChart').getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData = {
      labels  : ['Peserta Mengikuti Training', 'Pegawai mengikuti training', 'Pegawai mengikuti GIAT', 'Pegawai mengikuti Juara', 'Total Pegawai'],
      datasets: [
        // {
        //   label               : 'Electronics',
        //   fillColor           : 'rgba(210, 214, 222, 1)',
        //   strokeColor         : 'rgba(210, 214, 222, 1)',
        //   pointColor          : 'rgba(210, 214, 222, 1)',
        //   pointStrokeColor    : '#c1c7d1',
        //   pointHighlightFill  : '#fff',
        //   pointHighlightStroke: 'rgba(220,220,220,1)',
        //   data                : [65, 59, 80, 81]
        // },
        {
          label               : 'Jumlah Pegawai Berpartisipasi',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [{{$pesertatraining}},{{$pegawaitraining}}, {{$totalgiat}}, {{$totaljuara}}, {{$totalpegawai}}]
        }
      ]
    }
    barChartData.datasets[0].fillColor   = '#00a65a'
    barChartData.datasets[0].strokeColor = '#00a65a'
    barChartData.datasets[0].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true

    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
</script>
<script src="/AdminLTE/dist/js/pages/dashboard2.js"></script>
@endsection