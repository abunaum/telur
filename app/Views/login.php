<?= $this->extend('AuthTemplate/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                    <img src="assets/img/legijaya.jpeg" alt="">
                    <span class="d-none d-lg-block"><?= $namaweb; ?></span>
                </a>
            </div><!-- End Logo -->

            <div class="card mb-3">

                <div class="card-body">

                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Login ke Legi Jaya Farm</h5>
                        <p class="text-center small">Silahkan masukkan username dan password</p>
                    </div>

                    <form class="row g-3 needs-validation" action="<?= url_to('login') ?>" method="post" novalidate>
                        <?= csrf_field() ?>

                        <?php if ($config->validFields === ['email']) : ?>
                            <div class="form-group">
                                <label for="login"><?= lang('Auth.email') ?></label>
                                <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                                <div class="invalid-feedback">Masukkan Email.</div>
                            </div>
                        <?php else : ?>
                            <div class="form-group">
                                <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="Email atau username">
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="password"><?= lang('Auth.password') ?></label>
                            <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>
                        </div>

                        <?php if ($config->allowRemembering) : ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                    <?= lang('Auth.rememberMe') ?>
                                </label>
                            </div>
                        <?php endif; ?>
                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">Login</button>
                        </div>
                    </form>
                    <?= view('Myth\Auth\Views\_message_block') ?>
                </div>
            </div>

            <div class="credits">
                Designed by <a href="https://google.com/">Afif</a>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>