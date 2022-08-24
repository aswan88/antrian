<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section id="login">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5 shadow p-3 mb-5 bg-white rounded">
                <h5 class="mt-3 text-center">Login Pasien</h5>
                <hr class="mb-3">
                <!-- seting flash data -->
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php elseif (session()->getFlashdata('pesan_login')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('pesan_login'); ?>
                    </div>
                <?php endif; ?>
                <form action="/home/login_proses" method="post">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" aria-describedby="emailHelp" placeholder="Masukan email">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="exampleInputPassword1" placeholder="Password">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <button type="submit" class="btn btn-outline-info  w-75">LOGIN</button>
                    </div>

                </form>

                <hr>
                <div class="form-group row justify-content-center">
                    <a href="/home/daftar">Belum Punya Akun.! Daftar</a>
                </div>

            </div>
        </div>
    </div>
</section>





<?= $this->endSection(); ?>