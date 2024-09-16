@extends('layouts.app')

@section('contents')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Beranda</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Dashboard.beranda') }}">Menu</a></li>
                        <li class="breadcrumb-item">Beranda</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="get" action="{{ route('Dashboard.beranda') }}">
                <label for="condition">Select Condition:</label>
                <select name="condition" id="condition">
                    <option value="Disetujui" {{ $condition === 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="Ditolak" {{ $condition === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="Pengajuan" {{ $condition === 'Pengajuan' ? 'selected' : '' }}>Pengajuan</option>
                    <option value="Selesai" {{ $condition === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Dipinjam" {{ $condition === 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                </select>
                <button type="submit">Apply</button>
            </form>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $peminjamanbarangData }}</h3> 
                            <p>Peminjaman Barang ({{ $condition }})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('riwayatPeminjamanBarang.mahasiswa') }}" class="small-box-footer">Informasi Lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $peminjamanruanganData }}<sup style="font-size: 20px"></sup></h3>   
                            <p>Peminjaman Ruangan ({{ $condition }})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('riwayatPeminjamanRuangan.mahasiswa') }}" class="small-box-footer">Informasi Lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $ruanganData }}</h3>
                            <p>Ruangan Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('ruangan.index') }}" class="small-box-footer">Informasi Lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                          <h3>{{ $barangData }}</h3> 
                            <p>Barang Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('barang.index') }}" class="small-box-footer">Informasi Lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- BAR CHART -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Ruangan Yang Sering Dipinjam</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChartRuangan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-6">
                    <!-- PIE CHART -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Barang Yang Sering Dipinjam</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="barChartBarang" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col (RIGHT) -->
                <div class="col-md-12">
                    <!-- PIE CHART -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Waktu Peminjaman</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    $(function() {
        //--------------
        //- BAR CHART RUANGAN -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var crData = @json($chartRuangan);
        console.log(crData);
        var barChartCanvas = $('#barChartRuangan').get(0).getContext('2d');
        var barChartData = {
            labels: [crData.labelbulan[0]],
            datasets: [{
                    label: crData.namaruangan[0],
                    data: [crData.datajumlah[0]],
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                },
                {
                    label: crData.namaruangan[1],
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [crData.datajumlah[1]]
                },
                {
                    label: crData.namaruangan[2],
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [crData.datajumlah[2]]
                },
            ]
        }
        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0
                    }
                }]
            }
        }
        // This will get the first returned node in the jQuery collection.
        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        });

        //--------------
        //- BAR CHART BARANG -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var cbData = @json($chartBarang);
        console.log(cbData);
        var barChartCanvas2 = $('#barChartBarang').get(0).getContext('2d');
        var barChartData2 = {
            labels: [cbData.bulan[0]],
            datasets: [{
                    label: [cbData.barang[0]],
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [cbData.jumlah[0]]
                },
                {
                    label: [cbData.barang[1]],
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [cbData.jumlah[1]]
                }, {
                    label: [cbData.barang[2]],
                    backgroundColor: 'rgb(0, 192, 239)',
                    borderColor: 'rgb(0, 192, 239)',
                    pointRadius: false,
                    pointColor: 'rgb(0, 192, 239)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgb(0, 192, 239)',
                    data: [cbData.jumlah[2]]
                },
            ]
        }
        var barChartOptions2 = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0
                    }
                }]
            }
        }
        // This will get the first returned node in the jQuery collection.
        new Chart(barChartCanvas2, {
            type: 'bar',
            data: barChartData2,
            options: barChartOptions2
        });

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var cbPieData = @json($pieChart);
        var pieData = {
            labels: [
                '08.00 - 18.00',
                '18.00 - 21.00',
            ],
            datasets: [{
                data: [cbPieData.Pagi, cbPieData.Malam],
                backgroundColor: ['#f56954', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        }
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })

    })
</script>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END TABLE -->
@endsection
