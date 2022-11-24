<?= $this->extend('panel/template'); ?>
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
            <div class="row align-items-top justify-content-center">
                <?php if ($produk) : ?>
                    <?php foreach ($produk as $p) : ?>
                        <?php $id = $p['id']; ?>
                        <div class="col-lg-3">
                            <div class="card text-center">
                                <div class="card-header">
                                    <center>
                                        <h1><?= $p['nama']; ?></h1>
                                    </center>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= number_to_currency($p['harga'], 'IDR', 'id_ID'); ?> / Kg</h5>
                                    <p class="card-text">Stok : <?= $p['stok']; ?> Kg</p>
                                    <p class="card-text">Minimal Order : <?= $p['minorder']; ?> Kg</p>
                                    <p>Jumlah Order</p>
                                    <form action="<?= base_url("order/$id"); ?>" method="post">
                                        <?= csrf_field() ?>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" id="order" name="order" aria-describedby="orderinput" placeholder="Order" min="<?= $p['minorder']; ?>" required>
                                            <span class="input-group-text" id="orderinput">Kg</span>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Order</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h1>Produk tidak tersedia</h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>