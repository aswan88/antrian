<?= $this->extend('admin/adm_template/template'); ?>

<?= $this->section('adm_content'); ?>
<div class="container-fluid">
    <a href="/admin/antrian" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm m-4"><i class="fas fa-arrow-circle-left text-white"> Kembali</i>
    </a>
    <div class="card shadow mb-4" style="min-width: 80vw;">
        <div class="card-header py-3">
            <div class="row justify-content-between">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Antrian Loket (<?= $data['kd_antrian']; ?>) </h6>
                    <span class="text-success font-weight-bold" style="font-size: 12px;">
                        <i class="fa fa-circle text-warning"></i>
                        <?= $data['nama_dokter']; ?>
                    </span>
                </div>

                <div class="col">
                    <h6 class="font-weight-bold text-primary text-right">
                        <?= form_open('/antrian/resetAntrianDokter', ['class' => 'resetDokter']) ?>
                        <input type="hidden" name="dokter_id" value="<?= $data['dokter_id']; ?>">
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-sync fa-sm text-white-50"></i> RESET ANTRIAN</button>
                        <?= form_close(); ?>
                    </h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p>Rata-Rata Kedatangan per Jam</p>
            <div class="progress mb-4">
                <div class="progress-bar" role="progressbar" style="width: <?= $kedatangan; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= $kedatangan; ?> Pasien</div>
            </div>
            <p>Rata - Rata Pelayanan per jam</p>
            <div class="progress mb-4">
                <div class="progress-bar" role="progressbar" style="width: <?= $rata_per_jam; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= $rata_per_jam; ?> Pasien</div>
            </div>

            <p>Tingkat kesibukan (U = λ / μ)</p>
            <div class="progress mb-4">
                <div class="progress-bar" role="progressbar" style="width: <?= $itensitas * 100; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= $itensitas * 100; ?>%</div>
            </div>


            <div class="row justify-content-center align-items-center mb-4">
                <div class="item float-right">
                    <h6 class="font-weight-bold text-primary">
                        <?= form_open('/antrian/ulang', ['class' => 'ulang']) ?>
                        <input type="hidden" name="no_ulang" value="<?= (empty($antProses['no_antrian']) ? null :  $antProses['no_antrian']); ?>">
                        <button type="submit" class="btn btn-lg btn-warning"><i class="fas fa-sync fa-sm text-white-50"></i> PANGGIL ULANG</button>
                        <?= form_close(); ?>
                    </h6>
                </div>

                <div class="col bg-info border border-info" style="max-width: 120px; height: 120px; border-radius: 50%; text-align: center;">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-white" style="padding-top: 50%;">
                        <?php if (empty(($antProses['no_antrian']))) : ?>
                            selesai
                        <?php else : ?>
                            <?= $antProses['no_antrian']; ?>
                        <?php endif; ?>
                        </span>
                    </div>
                </div>

                <div class="item">
                    <?= form_open('/antrian/nextAntrian', ['class' => 'next']) ?>
                    <input type="hidden" name="tunggu_id" value="<?= (empty($antTunggu['antrian_id']) ? null :  $antTunggu['antrian_id']); ?>">
                    <input type="hidden" name="proses_id" value="<?= (empty($antProses['antrian_id']) ? null :  $antProses['antrian_id']); ?>">
                    <input type="hidden" name="no_tunggu" value="<?= (empty($antTunggu['no_antrian']) ? null :  $antTunggu['no_antrian']); ?>">

                    <?php if (empty($antProses)) : ?>
                        <button type="submit" class="d-none d-sm-inline-block btn btn-lg btn-primary shadow-sm">Mulai Antrian <i class="fas fa-play text-white-50"></i></button>
                    <?php else : ?>
                        <button type="submit" class="d-none d-sm-inline-block btn btn-lg btn-primary shadow-sm">Berikutnya<i class="fas fa-arrow-circle-right text-white-50"></i></button>
                    <?php endif; ?>
                    <?= form_close(); ?>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-3 mb-6">
                    <div class="card border-bottom-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Antrian</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Total = <?= $jmlAntrian; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Earnings (Monthly) Card Example -->

                <div class="col-xl-3 col-md-3 mb-6">
                    <div class="card border-bottom-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Antian Menunggu</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                <?php if (empty(($antTunggu['no_antrian']))) : ?>
                                                    selesai
                                                <?php else : ?>
                                                    <?= $antTunggu['no_antrian']; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-3 mb-6">
                    <div class="card border-bottom-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Antian Dalam Proses</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                <?php if (empty(($antProses['no_antrian']))) : ?>
                                                    selesai
                                                <?php else : ?>
                                                    <?= $antProses['no_antrian']; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-3 mb-6">
                    <div class="card border-bottom-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Antrian Selesai</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        total = <?= $slsAntrian; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="accordion" class="mt-5">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Detail Antrian
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NO ANTRIAN</th>
                                            <th scope="col">WAKTU ANTRI</th>
                                            <th scope="col">WAKTU PROSES</th>
                                            <th scope="col">STATUS</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $s = 1; ?>
                                        <?php foreach ($antrian as $row) : ?>
                                            <tr>
                                                <th scope="row"><?= $s; ?></th>
                                                <td><?= $row['no_antrian']; ?></td>
                                                <td><?= date('H:i', strtotime($row['created_at'])); ?></td>
                                                <td><?= date('H:i', strtotime($row['updated_at'])); ?></td>
                                                <td><?= $row['status_antrian']; ?></td>
                                                <td>
                                                    <a href="/admin/pasien/<?= $row['pasien_id']; ?>" class="btn btn-success">Lihat</a>
                                                </td>
                                            </tr>
                                            <?php $s++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('.next').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.success,
                        });
                        var msg = new SpeechSynthesisUtterance();
                        msg.lang = 'id-ID';
                        msg.text = response.antrian;
                        window.speechSynthesis.speak(msg);
                    }
                    if (response.kosong) {
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: response.kosong,
                        });
                    }
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 4000);
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + throwError);
                }

            })

        })

        $('.ulang').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.success,
                        });
                        var msg = new SpeechSynthesisUtterance();
                        msg.lang = 'id-ID';
                        msg.text = response.antrian;
                        window.speechSynthesis.speak(msg);
                    }
                    if (response.kosong) {
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: response.kosong,
                        });
                    }
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 4000);
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + throwError);
                }

            })

        })

        $('.resetDokter').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Reset',
                text: `Apakah Anda Ingin Mereset Antrian Ini Ini`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.success,
                                });
                            }
                            location.reload()
                        },
                        error: function(xhr, ajaxOptions, throwError) {
                            alert(xhr.status + '\n' + xhr.responseText + '\n' + throwError);
                        }

                    })
                }
            })
        })

    });
</script>
<?= $this->endSection(); ?>