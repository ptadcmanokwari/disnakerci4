<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3><?= $registrasi_count ?></h3>
                            <p>Registrasi</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-person-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $verifikasi_count ?></h3>
                            <p>Verifikasi</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $validasi_count ?></h3>
                            <p>Validasi</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $aktif_count ?></h3>
                            <p>Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-check2-square"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $bekerja_count ?></h3>
                            <p>Bekerja</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $wajib_lapor_count ?></h3>
                            <p>Wajib Lapor</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <section class="col-lg-6 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Statistik Pencari Kerja di Kabupaten Manokwari
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Pendidikan Terakhir</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Rentang Usia</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                    <div id="revenue-chart-container" style="height: 300px;"></div>
                                </div>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                    <div id="sales-chart-container" style="height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-6 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Statistik Pencari Kerja di Kabupaten Manokwari
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="chart tab-pane" id="line-chart" style="position: relative; height: 300px;">
                                <div id="line-chart-container" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="timeline p-3">
                            <div class="time-label">
                                <span class="bg-red">10 Feb. 2014</span>
                            </div>
                            <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                    <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-sm">Read more</a>
                                        <a class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-user bg-green"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-comments bg-yellow"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                    <div class="timeline-body">
                                        Take me to your leader!
                                        Switzerland is small and neutral!
                                        We are more like Germany, ambitious and misunderstood!
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-warning btn-sm">View comment</a>
                                    </div>
                                </div>
                            </div>
                            <div class="time-label">
                                <span class="bg-green">3 Jan. 2014</span>
                            </div>
                            <div>
                                <i class="fa fa-camera bg-purple"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                    <div class="timeline-body">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-video bg-maroon"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>
                                    <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                                    <div class="timeline-body">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var pendidikanData = <?= $pendidikan_data ?>;
        var usiaData = <?= $usia_data ?>;

        var currentYear = <?= $currentYear ?>;
        var months = <?= $months ?>;
        var lakiData = <?= $laki_data ?>;
        var perempuanData = <?= $perempuan_data ?>;

        var pendidikanChartData = pendidikanData.map(function(item) {
            return {
                name: item.pendidikan_terakhir,
                y: parseInt(item.jumlah)
            };
        });

        var usiaChartData = usiaData.map(function(item) {
            return {
                name: item.rentang_usia,
                y: parseInt(item.jumlah)
            };
        });

        Highcharts.chart('revenue-chart-container', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Pendidikan Terakhir'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: pendidikanChartData
            }]
        });

        Highcharts.chart('sales-chart-container', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Rentang Usia'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: usiaChartData
            }]
        });

        Highcharts.chart('line-chart-container', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Jumlah Permintaan Penerbitan Kartu Pencari Kerja Tahun ' + currentYear
            },
            xAxis: {
                categories: months
            },
            yAxis: {
                title: {
                    text: 'Jumlah Pencaker (orang)'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Laki-laki',
                data: lakiData
            }, {
                name: 'Perempuan',
                data: perempuanData
            }],
            credits: {
                enabled: false
            }
        });
    });
</script>
<?= $this->endSection() ?>