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
<!-- Begin Page Content -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div bgcolor="#f6f6f6" style="color: #333; height: 100%; width: 100%;" height="100%" width="100%" class="mb-3">
                <table bgcolor="#f6f6f6" cellspacing="0" style="border-collapse: collapse; padding: 40px; width: 100%;" width="100%">
                    <tbody>
                        <tr>
                            <td width="5px" style="padding: 0;"></td>
                            <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                                <table width="100%" cellspacing="0" style="border-collapse: collapse;">
                                    <tbody>
                                        <tr>
                                            <td style="padding: 0;">
                                                <a href="#" style="color: #348eda;" target="_blank">
                                                    <img src="<?= base_url('assets/img/legijaya.jpeg'); ?>" alt="LJF" style="height: 50px;" />
                                                </a>
                                            </td>
                                            <td style="color: #999; font-size: 12px; padding: 0; text-align: right;" align="right">
                                                Legi Jaya Farm<br />
                                                Invoice #<?= $transaksi['kode']; ?><br />
                                                <?= $transaksi['created_at']; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td width="5px" style="padding: 0;"></td>
                        </tr>

                        <tr>
                            <td width="5px" style="padding: 0;"></td>
                            <td bgcolor="#FFFFFF" style="border: 1px solid #000; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                                <table width="100%" style="background: #f9f9f9; border-bottom: 1px solid #eee; border-collapse: collapse; color: #999;">
                                    <tbody>
                                        <tr>
                                            <td width="50%" style="padding: 20px;"><strong style="color: #333; font-size: 24px;"><?= number_to_currency($transaksi['total_harga'], 'IDR', 'id_ID'); ?></strong></td>
                                            <td align="right" width="50%" style="padding: 20px;">Terimakasi telah membeli di <span class="il"><?= base_url(); ?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td style="padding: 0;"></td>
                            <td width="5px" style="padding: 0;"></td>
                        </tr>
                        <tr>
                            <td width="5px" style="padding: 0;"></td>
                            <td style="border: 1px solid #000; border-top: 0; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                                <table cellspacing="0" style="border-collapse: collapse; border-left: 1px solid #000; margin: 0 auto; max-width: 600px;">
                                    <tbody>
                                        <tr>
                                            <td valign="top" style="padding: 20px;">
                                                <h3 style="
                                            border-bottom: 1px solid #000;
                                            color: #000;
                                            font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;
                                            font-size: 18px;
                                            font-weight: bold;
                                            line-height: 1.2;
                                            margin: 0;
                                            margin-bottom: 15px;
                                            padding-bottom: 5px;
                                        ">
                                                    Detail User
                                                </h3>
                                                <table cellspacing="0" style="border-collapse: collapse;">
                                                    <tbody>
                                                        <tr>
                                                            <td>Nama</td>
                                                            <td>&nbsp;:&nbsp;</td>
                                                            <td><?= $transaksi['fullname']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Username</td>
                                                            <td>&nbsp;:&nbsp;</td>
                                                            <td>@<?= $transaksi['username']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>&nbsp;:&nbsp;</td>
                                                            <td><?= $transaksi['email']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat</td>
                                                            <td>&nbsp;:&nbsp;</td>
                                                            <td><?= $transaksi['alamat']; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" style="padding: 20px;">
                                                <h3 style="border-bottom: 1px solid #000; color: #000; font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif; font-size: 18px; font-weight: bold; line-height: 1.2; margin: 0; margin-bottom: 15px; padding-bottom: 5px;">
                                                    Detail Order &nbsp;
                                                    <?php if ($transaksi['status'] = 0) : ?>
                                                        (Ditolak)
                                                    <?php elseif ($transaksi['status'] = 1) : ?>
                                                        (Menunggu Di Proses)
                                                    <?php elseif ($transaksi['status'] = 2) : ?>
                                                        (Dikirim)
                                                    <?php elseif ($transaksi['status'] = 3) : ?>
                                                        (Selesai)
                                                    <?php endif; ?>
                                                </h3>
                                                <table cellspacing="0" style="border-collapse: collapse; margin-bottom: 40px; width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding: 5px 0;">Produk</td>
                                                            <td align="right" style="padding: 5px 0;"><?= $transaksi['nama_produk']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0;">Harga</td>
                                                            <td align="right" style="padding: 5px 0;"><?= number_to_currency($transaksi['total_harga'] / $transaksi['jumlah'], 'IDR', 'id_ID'); ?> / Kg</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0;">Jumlah Order</td>
                                                            <td align="right" style="padding: 5px 0;"><?= $transaksi['jumlah']; ?> Kg</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border-bottom: 2px solid #000; border-top: 2px solid #000; font-weight: bold; padding: 5px 0;">Total Bayar</td>
                                                            <td align="right" style="border-bottom: 2px solid #000; border-top: 2px solid #000; font-weight: bold; padding: 5px 0;"><?= number_to_currency($transaksi['total_harga'], 'IDR', 'id_ID'); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td width="5px" style="padding: 0;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <center>
                <a href="<?= base_url('transaksi-user'); ?>">
                    <button type="button" class="btn btn-info">List transaksi</button>
                </a>
                <?php if ($transaksi['status'] === '1') : ?>
                    <form class="d-inline" method="post" action="<?= base_url('bendahara/order/kirim/' . $transaksi['id']) ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT" />
                        <button type="button" class="btn btn-success kirim-order" data-transaksi="<?= $transaksi['kode']; ?>">
                            <i class="ri-send-plane-fill me-1"></i>Kirim
                        </button>
                    </form>
                    <form class="d-inline" method="post" action="<?= base_url('bendahara/order/tolak/' . $transaksi['id']) ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT" />
                        <button type="button" class="btn btn-danger tolak-order" data-transaksi="<?= $transaksi['kode']; ?>">
                            <i class="ri-close-circle-line me-1"></i>Tolak
                        </button>
                    </form>
                <?php elseif ($transaksi['status'] = 2) : ?>
                    <a href="<?= base_url('bendahara/invoice/' . $transaksi['kode']); ?>" target="_blank">
                        <button type="button" class="btn btn-warning">Cetak Invoice</button>
                    </a>
                    <form class="d-inline" method="post" action="<?= base_url('bendahara/order/selesai/' . $transaksi['id']) ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT" />
                        <button type="button" class="btn btn-success selesai-order" data-transaksi="<?= $transaksi['kode']; ?>">
                            <i class="ri-check-double-line me-1"></i>Selesai
                        </button>
                    </form>
                <?php endif; ?>
            </center>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    $(".kirim-order").on('click', function(e) {
        var kode = $(this).data('transaksi');
        Swal.fire({
            title: 'Anda yakin?',
            text: 'Mau akan mengubah status transaksi ' + kode + ' manjadi Dikirim ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Kirim',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.form.submit();
            }
        })
    })
</script>
<?= $this->endSection(); ?>