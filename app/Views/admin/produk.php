<?= $this->extend('panel/template'); ?>

<?= $this->section('head'); ?>
<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?php if (session()->getFlashdata('error')) : ?>
    <script>
        var err =
            Swal.fire({
                title: 'Ooops!',
                html: '<?= session()->getFlashdata('error'); ?>',
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
        var err =
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
                List Produk |&nbsp;
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahProduk">
                    <i class="ri-file-add-fill me-1"></i>
                    Tambah Produk
                </button>
            </h1>
            <div class="modal fade" id="tambahProduk" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Batal"></button>
                        </div>
                        <form method="post" action="<?= base_url('admin/produk/tambah'); ?>">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="col-md-12 mb-3">
                                    <label for="nama" class="form-label">
                                        Nama
                                    </label>
                                    <input type="text" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Nama" value="<?= old('nama'); ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="stok" class="form-label">
                                        Stok
                                    </label>
                                    <input type="number" class="form-control <?= $validation->hasError('stok') ? 'is-invalid' : ''; ?>" id="stok" name="stok" placeholder="Stok" value="<?= old('stok'); ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('stok'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="hg" class="form-label">
                                        Harga
                                    </label>
                                    <div class="input-group" id="hg">
                                        <span class="input-group-text" id="hargainput">Rp.</span>
                                        <input type="text" class="form-control <?= $validation->hasError('harga') ? 'is-invalid' : ''; ?>" id="harga" name="harga" aria-describedby="hargainput" placeholder="harga" value="<?= old('harga'); ?>" required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('harga'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary tambah_produk">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table id="produk" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produk as $prd) : ?>
                        <tr>
                            <td><?= $prd['nama']; ?></td>
                            <td><?= $prd['stok']; ?></td>
                            <td><?= number_to_currency($prd['harga'], 'IDR', 'id_ID'); ?></td>
                            <td>
                                <form class="d-inline" method="post" action="<?= base_url('admin/produk') . "/" . $prd['id']; ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="button" class="btn btn-danger hps-prd" data-nama="<?= $prd['nama']; ?>">
                                        <i class="ri-delete-bin-2-fill me-1"></i>
                                        Hapus
                                    </button>
                                </form>
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
<script type="text/javascript">
    var rupiah = document.getElementById('harga');
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
<script>
    $(document).ready(function() {
        $('#produk').DataTable();
    });

    $(".tambah_produk").on('click', function(e) {
        var hargaawal = document.getElementById("harga").value.toString();
        var harga = hargaawal.split('.').join("");
        document.getElementById("harga").value = parseInt(harga);
        this.form.submit();
    });

    $(".hps-prd").on('click', function(e) {
        var nama = $(this).data('nama');
        Swal.fire({
            title: 'Anda yakin?',
            text: 'Mau menghapus ' + nama + ' ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.form.submit();
            }
        })
    })
</script>
<?= $this->endSection(); ?>