<?= $this->extend('panel/template'); ?>

<?= $this->section('head'); ?>
<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
                List Transaksi
            </h1>
            <table id="transaksi" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah Order</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $t) : ?>
                        <tr>
                            <td>
                                <?= $t['kode']; ?>
                            </td>
                            <td>
                                <?= $t['nama_produk']; ?>
                            </td>
                            <td>
                                <?= number_to_currency($t['total_harga'] / $t['jumlah'], 'IDR', 'id_ID'); ?> / Kg
                            </td>
                            <td>
                                <?= $t['jumlah']; ?>
                            </td>
                            <td>
                                <?php if ($t['status'] === '1') : ?>
                                    Menunggu Respon
                                <?php elseif ($t['status'] === '2') : ?>
                                    Dikirim
                                <?php elseif ($t['status'] === '3') : ?>
                                    Selesai
                                <?php else : ?>
                                    Ditolak
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('transaksi-user/detail/' . $t['id']); ?>">
                                    <button type="button" class="btn btn-info">Detail</button>
                                </a>
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
<script>
    $(document).ready(function() {
        $('#transaksi').DataTable();
    });
</script>
<?= $this->endSection(); ?>