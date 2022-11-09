<?= $this->extend('panel/template'); ?>

<?= $this->section('head'); ?>
<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">
                List User |&nbsp;
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahUser">
                    <i class="ri-file-add-fill me-1"></i>
                    Tambah User
                </button>
            </h1>
            <div class="modal fade" id="tambahUser" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Batal"></button>
                        </div>
                        <form method="post" action="<?= base_url('admin/user/tambah'); ?>">
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <label for="nama" class="form-label">
                                        Nama
                                    </label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">
                                        Email
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="email@client.com" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="ug" class="form-label">
                                        Username
                                    </label>
                                    <div class="input-group" id="ug">
                                        <span class="input-group-text" id="usernameinput">@</span>
                                        <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameinput" placeholder="username" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="password" class="form-label">
                                        Password
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
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
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user as $usr) : ?>
                        <tr>
                            <td><?= $usr['fullname']; ?></td>
                            <td><?= $usr['username']; ?></td>
                            <td><?= $usr['email']; ?></td>
                            <td><?= ucfirst($usr['group']['name']); ?></td>
                            <td>
                                <button type="button" class="btn btn-warning">
                                    <i class="ri-edit-circle-fill me-1"></i>
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger">
                                    <i class="ri-delete-bin-2-fill me-1"></i>
                                    Hapus
                                </button>
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
</script>
<?= $this->endSection(); ?>