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
                html: 'Gagal menambah data user.<br>Silahkan coba lagi.',
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
                List Bendahara |&nbsp;
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahBendahara">
                    <i class="ri-file-add-fill me-1"></i>
                    Tambah Bendahara
                </button>
            </h1>
            <div class="modal fade" id="tambahBendahara" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Bendahara</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Batal"></button>
                        </div>
                        <form method="post" action="<?= base_url('admin/bendahara/tambah'); ?>">
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
                                    <label for="alamat" class="form-label">
                                        Alamat
                                    </label>
                                    <input type="text" class="form-control <?= $validation->hasError('alamat') ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" placeholder="Alamat" value="<?= old('alamat') ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('alamat'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="email" class="form-label">
                                        Email
                                    </label>
                                    <input type="email" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="email@client.com" value="<?= old('email'); ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="ug" class="form-label">
                                        Username
                                    </label>
                                    <div class="input-group" id="ug">
                                        <span class="input-group-text" id="usernameinput">@</span>
                                        <input type="text" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : ''; ?>" id="username" name="username" aria-describedby="usernameinput" placeholder="username" value="<?= old('username'); ?>" required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('username'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="password" class="form-label">
                                        Password
                                    </label>
                                    <input type="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password" value="<?= old('password'); ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table id="user" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user as $usr) : ?>
                        <tr>
                            <td><?= $usr['fullname']; ?></td>
                            <td><?= $usr['username']; ?></td>
                            <td><?= $usr['email']; ?></td>
                            <td><?= $usr['alamat']; ?></td>
                            <td>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editAlamat-<?= $usr['id']; ?>">
                                    <i class="ri-edit-box-line me-1"></i>
                                </button>
                                <div class="modal fade" id="editAlamat-<?= $usr['id']; ?>" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit alamat</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Batal"></button>
                                            </div>
                                            <form method="post" action="<?= base_url('admin/user/alamat/' . $usr['id']); ?>">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="PUT" />
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <label for="alamat" class="form-label">
                                                            alamat
                                                        </label>
                                                        <input type="text" class="form-control <?= $validation->hasError('alamat') ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" placeholder="alamat" value="<?= old('alamat') ?? $usr['alamat'] ?>" required>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('alamat'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form class="d-inline" method="post" action="<?= base_url('admin/bendahara') . "/" . $usr['id']; ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <button type="button" class="btn btn-warning reset-usr" data-email="<?= $usr['email']; ?>" data-username="<?= $usr['username']; ?>">
                                        <i class="ri-edit-circle-fill me-1"></i>
                                    </button>
                                </form>
                                <form class="d-inline" method="post" action="<?= base_url('admin/bendahara') . "/" . $usr['id']; ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="button" class="btn btn-danger hps-usr" data-email="<?= $usr['email']; ?>">
                                        <i class="ri-delete-bin-2-fill me-1"></i>
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
<script>
    $(document).ready(function() {
        $('#user').DataTable();
    });

    $(".hps-usr").on('click', function(e) {
        var email = $(this).data('email');
        Swal.fire({
            title: 'Anda yakin?',
            text: 'Mau menghapus ' + email + ' ?',
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

    $(".reset-usr").on('click', function(e) {
        var email = $(this).data('email');
        var username = $(this).data('username');
        Swal.fire({
            title: 'Anda yakin?',
            text: 'Mau mereset password ' + email + ' menjadi "' + username + '" ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reset',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.form.submit();
            }
        })
    })
</script>
<?= $this->endSection(); ?>