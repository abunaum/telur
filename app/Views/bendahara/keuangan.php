<?= $this->extend('panel/template'); ?>

<?= $this->section('head'); ?>
<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?php if (session()->getFlashdata('error')) : ?>
    <script>
        var err = '<?= session()->getFlashdata('error'); ?>';
        Swal.fire({
            title: 'Ooops!',
            html: err,
            icon: 'error',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            didOpen: () => {},
            willClose: () => {}
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {}
        })
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        var pesan = '<?= session()->getFlashdata('pesan'); ?>';
        Swal.fire({
            title: 'Mantap',
            html: pesan,
            icon: 'success',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            didOpen: () => {},
            willClose: () => {}
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {}
        })
    </script>
<?php endif; ?>
<!-- Begin Page Content -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">
                Keuangan |&nbsp;
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahlog">
                    <i class="ri-file-add-fill me-1"></i>
                    Tambah
                </button>
            </h1>
            <div class="modal fade" id="tambahlog" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data Keuangan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Batal"></button>
                        </div>
                        <form method="post" action="<?= base_url('bendahara/keuangan/tambah'); ?>">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Jenis</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Jenis" name="jenis" id="jenis">
                                            <option value="keluar">Pengeluaran</option>
                                            <option value="masuk">Pemasukan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nominal</label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="nominal-add">Rp.</span>
                                            <input type="text" class="form-control" placeholder="1000" aria-label="nominal" id="nominal" name="nominal" aria-describedby="nominal-add">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">Keterangan</span>
                                    <textarea class="form-control" name="keterangan" id="keterangan" aria-label="With textarea"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary tambah_dana_log">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table id="keuangan" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Nominal</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($LogSaldo as $ls) : ?>
                        <?php
                        $time = explode(' ', $ls['created_at']);
                        $tanggal = (string)$time[0];
                        $nominal = number_to_currency($ls['nominal'], 'IDR', 'id_ID');
                        ?>
                        <tr>
                            <td>
                                <?= tgl_indo($tanggal); ?>
                            </td>
                            <td>
                                <?= ucfirst($ls['jenis']); ?>
                            </td>
                            <td>
                                <?= $ls['jenis'] === 'masuk' ? '+ ' . $nominal : '- ' . $nominal; ?>
                            </td>
                            <td>
                                <?= $ls['keterangan']; ?>
                            </td>
                            <td>
                                <?php if (strpos($ls['keterangan'], 'dengan kode transaksi ') !== false) : ?>
                                    <?php
                                    $getkode = explode('dengan kode transaksi ', $ls['keterangan']);
                                    $kode = $getkode[1];
                                    ?>
                                    <form action="<?= base_url('transaksi-user/cek-kode/' . $kode); ?>" method="post">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-info">Detail</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        $('#keuangan').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    $(".tambah_dana_log").on('click', function(e) {
        var nominalawal = document.getElementById("nominal").value.toString();
        var nominal = nominalawal.split('.').join("");
        document.getElementById("nominal").value = parseInt(nominal);
        this.form.submit();
    });
</script>
<script type="text/javascript">
    var rupiah = document.getElementById('nominal');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        if (this.value.charAt(0) === '0') {
            rupiah.value = '';
        } else {
            rupiah.value = formatRupiah(this.value, '');
        }
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }
</script>
<?= $this->endSection(); ?>