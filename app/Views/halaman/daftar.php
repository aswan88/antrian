<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<section id="daftar">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 shadow p-3 mb-5 bg-white rounded">
                <h5 class="mt-3 text-center">Daftar Pasien</h5>
                <hr class="mb-3">

                <form action="/home/save_daftar" method="post" enctype="multipart/form-data">

                    <?= csrf_field(); ?>


                    <div class="form-group row">
                        <div class="col">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Masukan Nama Lengkap" value="<?= old('nama'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Masukan Email" value="<?= old('email'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col">
                            <label for="password">Password</label>
                            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Masukan Password" value="<?= old('password'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col">
                            <label for="v_password">Verifikasi Password</label>
                            <input type="password" class="form-control  <?= ($validation->hasError('v_password')) ? 'is-invalid' : ''; ?>" id="v_password" name="v_password" placeholder="Masukan Ulang Password" value="<?= old('v_password'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('v_password'); ?>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row justify-content-center">
                        <button type="submit" class="btn btn-outline-info w-50">Daftar</button>
                    </div>

                    <div class="form-group row justify-content-center">
                        <a href="/home/login">Sudah Punya Akun Kembali Ke Login</a>
                    </div>


                </form>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection(); ?>