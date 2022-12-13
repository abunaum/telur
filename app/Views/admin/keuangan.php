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
                Log Keuangan
            </h1>
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
                                    <form action="<?= base_url('transaksi/cek-kode/' . $kode); ?>" method="post">
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
</script>
<?= $this->endSection(); ?>