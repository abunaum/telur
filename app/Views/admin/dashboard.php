<?= $this->extend('panel/template'); ?>

<?= $this->section('content'); ?>
<script>
    Swal.fire({
        title: 'Info !',
        html: 'Ini Masih Demo, By : Abunaum',
        icon: 'warning',
        timer: 10000,
        timerProgressBar: true,
        showConfirmButton: false,
        didOpen: () => {},
        willClose: () => {}
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {}
    })
</script>
<!-- Begin Page Content -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row align-items-top justify-content-center">
                <h1 class="mb-4 text-gray-800">Selamat datang di Aplikasi Legi Jaya Farm.</h1>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Transaksi</h5>
                            <div id="transaksi" style="min-height: 400px;" class="echart"></div>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    echarts.init(document.querySelector("#transaksi")).setOption({
                                        tooltip: {
                                            trigger: 'item'
                                        },
                                        legend: {
                                            top: '5%',
                                            left: 'center'
                                        },
                                        series: [{
                                            name: 'Transaksi',
                                            type: 'pie',
                                            radius: ['40%', '70%'],
                                            avoidLabelOverlap: false,
                                            label: {
                                                show: false,
                                                position: 'center'
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                }
                                            },
                                            labelLine: {
                                                show: false
                                            },
                                            data: [{
                                                    value: <?= $ts; ?>,
                                                    name: 'Selesai'
                                                },
                                                {
                                                    value: <?= $tk; ?>,
                                                    name: 'Dikirim'
                                                },
                                                {
                                                    value: <?= $tp; ?>,
                                                    name: 'Proses'
                                                },
                                                {
                                                    value: <?= $tt; ?>,
                                                    name: 'Ditolak'
                                                },
                                            ]
                                        }]
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Saldo</h5>
                            <div id="saldo" style="min-height: 400px;" class="echart"></div>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    echarts.init(document.querySelector("#saldo")).setOption({
                                        tooltip: {
                                            trigger: 'item'
                                        },
                                        legend: {
                                            top: '5%',
                                            left: 'center'
                                        },
                                        series: [{
                                            name: 'Saldo',
                                            type: 'pie',
                                            radius: ['40%', '70%'],
                                            avoidLabelOverlap: false,
                                            label: {
                                                show: false,
                                                position: 'center'
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                }
                                            },
                                            labelLine: {
                                                show: false
                                            },
                                            data: [{
                                                    value: <?= $nlsm; ?>,
                                                    name: 'Masuk'
                                                },
                                                {
                                                    value: <?= $nlsk; ?>,
                                                    name: 'Keluar'
                                                },
                                            ]
                                        }]
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url('assets/extends/echarts/echarts.min.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<?= $this->endSection(); ?>