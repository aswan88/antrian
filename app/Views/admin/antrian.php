<?= $this->extend('admin/adm_template/template'); ?>

<?= $this->section('adm_content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="col">
            <h1 class="h3 mb-0 text-gray-800">Kelolah Antrian</h1>
        </div>
        <div class="col">
            <h6 class="font-weight-bold text-primary text-right">
                <?= form_open('/antrian/resetAntrian', ['class' => 'reset']) ?>

                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-sync fa-sm text-white-50"></i> RESET ANTRIAN</button>
                <?= form_close(); ?>
            </h6>
        </div>
    </div>
    <!-- JavaScript
    <button onclick="responsiveVoice.speak('The Internet is a series of tubes!');" type="button" value="Play">Play</button> -->
    <div class="row">
        <?php foreach ($dataDokter as $data) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-bottom-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col">
                                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Loket</div>
                            </div>

                            <div class="col">
                                <a href="#" class="setting text-primary float-right" data-id="<?= $data['dokter_id']; ?>"><i class="fa fa-cog"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="h2 mb-0 font-weight-bold text-gray-800 border border-info p-2 mb-4 mt-4"><?= $data['kd_antrian']; ?></div>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><?= $data['nama_dokter']; ?></div>
                                <?php if ($data['status'] == 'Buka') : ?>
                                    <span class="text-success font-weight-bold" style="font-size: 9px;">
                                        <i class="fa fa-circle text-success"></i> Status:
                                        <?= $data['status']; ?>
                                    </span>
                                <?php else : ?>
                                    <span class="text-danger font-weight-bold" style="font-size: 9px;">
                                        <i class="fa fa-circle text-danger"></i> Status:
                                        <?= $data['status']; ?>
                                    </span>
                                <?php endif; ?>

                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                <span class="badge badge-danger badge-counter" style="margin-top: -10rem;" class="counter">0
                                    <?php foreach ($notif as $n) : ?>
                                        <?php
                                        if ($data['dokter_id'] == $n['dokter_id']) {
                                            echo $s = $n['countD'];
                                        }
                                        ?>
                                    <?php endforeach; ?>
                                </span>
                            </div>
                        </div>
                        <a href="/admin/viewAntrian/<?= $data['dokter_id']; ?>" class="get btn btn-outline-info w-100 text-success" data-id=""><i class="fa fa-tasks"></i> Kelolah </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- modal setting -->
    <div class="modalSetting" style="display: none;"></div>


    <script>
        $(document).ready(function() {

            $('.reset').submit(function(e) {
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

            // Ajax Setting 
            $('.setting').click(function() {
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    type: "get",
                    url: "/admin/modalSetting",
                    data: {
                        dokter_id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('.modalSetting').html(response.data).show();

                        $('#settingModalShow').modal('show');

                    },
                    error: function(xhr, ajaxOptions, throwError) {
                        alert(xhr.status + '\n' + xhr.responseText + '\n' + throwError);
                    }

                });
                return false;
            });
        })
    </script>
    <?= $this->endSection(); ?>