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
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">Nama</th>
                        <td><?= $user->fullname; ?></td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editNama">
                                <i class="ri-edit-box-line me-1"></i>
                                Edit Nama
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><?= $user->email; ?></td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editEmail">
                                <i class="ri-edit-box-line me-1"></i>
                                Edit Email
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Username</th>
                        <td>@<?= $user->username; ?></td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editUsername">
                                <i class="ri-edit-box-line me-1"></i>
                                Edit Username
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Notifikasi</th>
                        <?php if ($telegram['tele_id'] === '') : ?>
                            <td>Mati</td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#aktifkanNotifikasi">
                                    <i class="ri-notification-2-line me-1"></i>
                                    Aktifkan Notifikasi
                                </button>
                            </td>
                        <?php elseif ($telegram['status'] === "invalid") : ?>
                            <td>Belum diverifikasi (<?= $telegram['tele_id']; ?>)</td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#verifNotifikasi">
                                    <i class="ri-notification-2-line me-1"></i>
                                    Verifikasi
                                </button>
                                <form method="post" action="<?= base_url($group . '/setting/reset-tele'); ?>" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <button type="submit" class="btn btn-primary">Reset Id Telegram</button>
                                </form>
                            </td>
                            Belum diverifikasi
                        <?php else : ?>
                            <td>Aktif (<?= $telegram['tele_id']; ?>)</td>
                            <td>
                                <form method="post" action="<?= base_url($group . '/setting/reset-tele'); ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <button type="submit" class="btn btn-primary">Reset Id Telegram</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#gantiPassword">
                <i class="ri-lock-password-line me-1"></i>
                Ganti Password
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="editNama" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Nama</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Batal"></button>
            </div>
            <form method="post" action="<?= base_url($group . '/setting/nama'); ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT" />
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="nama" class="form-label">
                            Nama
                        </label>
                        <input type="text" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Nama" value="<?= old('nama') ?? $user->fullname ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
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

<div class="modal fade" id="editEmail" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Batal"></button>
            </div>
            <form method="post" action="<?= base_url($group . '/setting/email'); ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT" />
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="email" class="form-label">
                            Email
                        </label>
                        <input type="email" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="email@client.com" value="<?= old('email') ?? $user->email ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
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

<div class="modal fade" id="editUsername" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Username</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Batal"></button>
            </div>
            <form method="post" action="<?= base_url($group . '/setting/username'); ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT" />
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="ug" class="form-label">
                            Username
                        </label>
                        <div class="input-group" id="ug">
                            <span class="input-group-text" id="usernameinput">@</span>
                            <input type="text" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : ''; ?>" id="username" name="username" aria-describedby="usernameinput" placeholder="username" value="<?= old('username') ?? $user->username ?>" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
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

<div class="modal fade" id="gantiPassword" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Batal"></button>
            </div>
            <form method="post" action="<?= base_url($group . '/setting/password'); ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT" />
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="prevpassword" class="form-label">
                            Password Lama
                        </label>
                        <input type="password" class="form-control <?= $validation->hasError('prevpassword') ? 'is-invalid' : ''; ?>" id="prevpassword" name="prevpassword" value="<?= old('prevpassword'); ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('prevpassword'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="newpassword" class="form-label">
                            Password baru
                        </label>
                        <input type="password" class="form-control <?= $validation->hasError('newpassword') ? 'is-invalid' : ''; ?>" id="newpassword" name="newpassword" value="<?= old('newpassword'); ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('newpassword'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="repeatpassword" class="form-label">
                            Ulangi Password baru
                        </label>
                        <input type="password" class="form-control <?= $validation->hasError('repeatpassword') ? 'is-invalid' : ''; ?>" id="repeatpassword" name="repeatpassword" value="<?= old('repeatpassword'); ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('repeatpassword'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ubah password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="aktifkanNotifikasi" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aktifkan Notifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Batal"></button>
            </div>
            <form method="post" action="<?= base_url($group . '/setting/notifikasi'); ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT" />
                <div class="modal-body">
                    <p>Untuk mendapatkan Telegram ID silahkan chat <a href="https://t.me/LegiJayaFarm_bot" target="_blank" rel="noopener noreferrer">@LegiJayaFarm_bot</a></p>
                    <div class="col-md-12">
                        <label for="tele_id" class="form-label">
                            ID Telegram
                        </label>
                        <input type="tele_id" class="form-control <?= $validation->hasError('tele_id') ? 'is-invalid' : ''; ?>" id="tele_id" name="tele_id" placeholder="Masukkan id telegram" value="<?= old('tele_id') ?? $telegram['tele_id'] ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('tele_id'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="verifNotifikasi" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verifikasi Notifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Batal"></button>
            </div>
            <form method="post" action="<?= base_url($group . '/setting/verif-notifikasi'); ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT" />
                <div class="modal-body">
                    <p>ID Telegram anda adalah : <?= $telegram['tele_id'] ?? "undefined"; ?></p>
                    <div class="col-md-12">
                        <label for="kode" class="form-label">
                            Kode Verifikasi
                        </label>
                        <input type="kode" class="form-control <?= $validation->hasError('kode') ? 'is-invalid' : ''; ?>" id="kode" name="kode" placeholder="Masukkan kode" value="<?= old('kode') ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kode'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>