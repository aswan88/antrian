<!-- Modal Dokter -->
<div class="modal fade" id="settingModalShow" tabindex="-1" role="dialog" aria-labelledby="settingModalShowLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="settingModalShowLabel">Pengaturan Antrian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('/antrian/setting', ['class' => 'formTambah']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="dokter_id" value="<?= $dataDokter['dokter_id']; ?>">
            <input type="hidden" name="jam_buka" value="<?= $dataDokter['jam_buka']; ?>">
            <input type="hidden" name="jam_tutup" value="<?= $dataDokter['jam_tutup']; ?>">
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="card border-bottom-info shadow w-50 ">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Loket</div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="h2 mb-0 font-weight-bold text-gray-800 border border-info p-2 mb-4 mt-4"><?= $dataDokter['kd_antrian']; ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><?= $dataDokter['nama_dokter']; ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <?php if ($dataDokter['status'] == 'Buka') : ?>
                                    <span class="text-success font-weight-bold" style="font-size: 9px;">
                                        <i class="fa fa-circle text-success"></i> Status Sekarang:
                                        <?= $dataDokter['status']; ?>
                                    </span>
                                <?php else : ?>
                                    <span class="text-danger font-weight-bold" style="font-size: 9px;">
                                        <i class="fa fa-circle text-danger"></i> Status Sekarang:
                                        <?= $dataDokter['status']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="row mt-2">
                                <span class="text-info font-weight-bold" style="font-size: 9px;">
                                    <i class="fa fa-circle text-info"></i> Buka:
                                    <?= $dataDokter['jam_buka']; ?>
                                </span>
                            </div>
                            <div class="row justify-content-end">
                                <span class="text-danger font-weight-bold" style="font-size: 9px;">
                                    <i class="fa fa-circle text-danger"></i> Tutup:
                                    <?= $dataDokter['jam_tutup']; ?>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pl-5">
                    <div class="col">
                        <div class="form-row mt-5">
                            <label for="jam_buka" class="font-weight-bold text-primary text-uppercase">Waktu Buka Antrian</label>
                        </div>
                        <div class="form-row">
                            <input type="radio" class="form-check-input" name="buka_antrian" checked data-toggle="toggle" data-size="xs">
                            <p class="text-success" style="font-size: 0.8rem;" value="sesuai"> Sesuai Jam Praktek</p>
                        </div>
                        <div class="form-row">
                            <input type="radio" class="form-check-input" name="buka_antrian" value="15 menit" data-toggle="toggle" data-size="xs">
                            <p class="text-success" style="font-size: 0.8rem;"> 15 menit sebelum Jam Praktek</p>
                        </div>

                        <div class="form-row">
                            <input type="radio" class="form-check-input" name="buka_antrian" value="30 menit" data-toggle="toggle" data-size="xs">
                            <p class="text-success" style="font-size: 0.8rem;"> 30 menit sebelum Jam Praktek</p>
                        </div>

                        <div class="form-row">
                            <input type="radio" class="form-check-input" value="1 jam" name="buka_antrian" data-toggle="toggle" data-size="xs">
                            <p class="text-success" style="font-size: 0.8rem;"> 1 Jam Sebelum Jam Praktek</p>
                        </div>


                        <div class="form-row">
                            <input type="radio" class="form-check-input" value="2 jam" name="buka_antrian" data-toggle="toggle" data-size="xs">
                            <p class="text-success" style="font-size: 0.8rem;"> 2 Jam Sebelum Jam Praktek</p>
                        </div>

                        <div class="form-row">
                            <input type="radio" class="form-check-input" value="sekarang" name="buka_antrian" data-toggle="toggle" data-size="xs">
                            <p class="text-success" style="font-size: 0.8rem;"> Buka Sekarang</p>
                        </div>

                    </div>
                    <div class="col">
                        <div class="form-row mt-5">
                            <label for="jam_buka" class="font-weight-bold text-primary text-uppercase">Waktu Tutup Antrian</label>
                        </div>
                        <div class="form-row">
                            <input type="radio" class="form-check-input" value="sesuai" name="tutup_antrian" checked data-toggle="toggle" data-size="xs">
                            <p class="text-success" style="font-size: 0.8rem;"> Sesuai Jam Tutup</p>
                        </div>
                        <div class="form-row">
                            <input type="radio" class="form-check-input" value="15 menit" name="tutup_antrian" data-toggle="toggle" data-size="xs">
                            <p class="text-success" style="font-size: 0.8rem;"> 15 menit sebelum Jam Tutup</p>
                        </div>

                        <div class="form-row">
                            <input type="radio" class="form-check-input" value="30 menit" name="tutup_antrian" data-toggle="toggle" data-size="xs">
                            <p class="text-success" style="font-size: 0.8rem;"> 30 menit sebelum Jam Tutup</p>
                        </div>

                        <div class="form-row">
                            <input type="radio" class="form-check-input" value="sekarang" name="tutup_antrian" data-toggle="toggle" data-size="xs">
                            <p class="text-success" style="font-size: 0.8rem;"> Tutup Sekarang</p>
                        </div>

                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary simpan">Simpan Data</button>
            </div>

            <?php form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formTambah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.simpan').attr('disable', 'disabled');
                    $('.simpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.simpan').removeAttr('disable', 'disabled');
                    $('.simpan').html('simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.sip) {
                            $('#sip').addClass('is-invalid');
                            $('.errorSIP').html(response.error.sip);
                        } else {
                            $('#sip').removeClass('is-invalid');
                            $('.errorSIP').html('');
                        }
                    } else(
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success,
                        }),
                        $('#settingModalShow').modal('hide')
                    )
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + throwError);
                }

            });
            return false;
        })

    });
</script>