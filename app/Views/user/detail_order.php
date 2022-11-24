<?= $this->extend('panel/template'); ?>
<?= $this->section('content'); ?>
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
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">Kode Transaksi</th>
                        <td><?= $transaksi['kode']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Produk</th>
                        <td><?= $transaksi['nama_produk']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Harga</th>
                        <td><?= number_to_currency($transaksi['total_harga'] / $transaksi['jumlah'], 'IDR', 'id_ID'); ?> / Kg</td>
                    </tr>
                    <tr>
                        <th scope="row">Jumlah Order</th>
                        <td><?= $transaksi['jumlah']; ?> Kg</td>
                    </tr>
                    <tr>
                        <th scope="row">Total Bayar</th>
                        <td><?= number_to_currency($transaksi['total_harga'], 'IDR', 'id_ID'); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Status</th>
                        <td><?= ucwords($transaksi['status']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>