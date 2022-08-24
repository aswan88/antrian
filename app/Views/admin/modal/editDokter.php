<!-- Modal Dokter -->
<div class="modal fade" id="editModalShow" tabindex="-1" role="dialog" aria-labelledby="editModalShowLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalShowLabel">Edit Data Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('/admin/edit_dokter', ['class' => 'formEdit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <input type="hidden" name="dokter_id" value="<?= $dataDokter['dokter_id']; ?>">


                <div class="form-group">
                    <label for="sip">SIP</label>
                    <input type="text" name="sip" id="sip" class="form-control" value="<?= $dataDokter['SIP']; ?>" autofocusvalue="<?= old('sip'); ?>">
                    <div class="invalid-feedback errorSIP">

                    </div>
                </div>


                <div class="form-group">
                    <label for="nama_dokter">Nama Lengkap</label>
                    <input type="text" name="nama_dokter" id="nama_dokter" class="form-control" value="<?= $dataDokter['nama_dokter']; ?>" autofocusvalue="<?= old('nama_dokter'); ?>">

                    <div class="invalid-feedback errorNamaDokter">

                    </div>
                </div>


                <div class="form-group">
                    <label for="spesialisasi">Spesialisasi</label>
                    <input type="text" name="spesialisasi" id="spesialisasi" class="form-control" value="<?= $dataDokter['spesialisasi']; ?>" autofocusvalue="<?= old('spesialisasi'); ?>">

                    <div class="invalid-feedback errorSpesialisasi">

                    </div>
                </div>

                <?php
                $hari = explode(' - ', $dataDokter['hari_praktek']);
                ?>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="hari_praktek1">Hari Awal</label>
                        <select name="hari_praktek1" id="hari_praktek1" class="form-control" autofocusvalue="<?= old('hari_praktek1'); ?>">
                            <option value="Senin" <?php if ($hari[0] == "Senin") echo "selected"; ?>>Senin</option>
                            <option value="Selasa" <?php if ($hari[0] == "Selasa") echo "selected"; ?>>Selasa</option>
                            <option value="Rabu" <?php if ($hari[0] == "Rabu") echo "selected"; ?>>Rabu</option>
                            <option value="Kamis" <?php if ($hari[0] == "Kamis") echo "selected"; ?>>Kamis</option>
                            <option value="Jumat" <?php if ($hari[0] == "Jumat") echo "selected"; ?>>Jumat</option>
                            <option value="Sabtu" <?php if ($hari[0] == "Sabtu") echo "selected"; ?>>Sabtu</option>
                            <option value="Minggu" <?php if ($hari[0] == "Minggu") echo "selected"; ?>>Minggu</option>
                        </select>

                        <div class=" invalid-feedback errorHari1">
                        </div>
                    </div>

                    <div class="form-group col-md-2 pt-5 text-center">
                        <span>s/d</span>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="hari_praktek2">Hari Akhir</label>
                        <select name="hari_praktek2" id="hari_praktek2" class="form-control" autofocusvalue="<?= old('hari_praktek2'); ?>">
                            <option value="Senin" <?php if ($hari[1] == "Senin") echo "selected"; ?>>Senin</option>
                            <option value="Selasa" <?php if ($hari[1] == "Selasa") echo "selected"; ?>>Selasa</option>
                            <option value="Rabu" <?php if ($hari[1] == "Rabu") echo "selected"; ?>>Rabu</option>
                            <option value="Kamis" <?php if ($hari[1] == "Kamis") echo "selected"; ?>>Kamis</option>
                            <option value="Jumat" <?php if ($hari[1] == "Jumat") echo "selected"; ?>>Jumat</option>
                            <option value="Sabtu" <?php if ($hari[1] == "Sabtu") echo "selected"; ?>>Sabtu</option>
                            <option value="Minggu" <?php if ($hari[1] == "Minggu") echo "selected"; ?>>Minggu</option>
                        </select>
                        <div class=" invalid-feedback errorHari2">
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="jam_buka">Jam Buka</label>
                        <input type="time" class="form-control" id="jam_buka" name="jam_buka" placeholder="jam buka" value="<?= $dataDokter['jam_buka']; ?>" autofocusvalue="<?= old('jam_buka'); ?>">

                        <div class=" invalid-feedback errorJamBuka">
                        </div>
                    </div>

                    <div class="form-group col-md-2 pt-5 text-center">
                        <span>s/d</span>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="jam_tutup">Jam Tutup</label>
                        <input type="time" class="form-control" id="jam_tutup" name="jam_tutup" value="<?= $dataDokter['jam_tutup']; ?>" placeholder="jam Tutup" autofocusvalue="<?= old('jam_tutup'); ?>">

                        <div class=" invalid-feedback errorJamTutup">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="kd_antrian">KodeAntrian</label>
                    <select name="kd_antrian" id="kd_antrian" class="form-control" autofocusvalue="<?= old('kd_antrian'); ?>">
                        <?php foreach (range('A', 'Z') as $char) : ?>
                            <option value="<?= $char; ?>" <?php if ($char ==  $dataDokter['kd_antrian']) echo "selected"; ?>><?= $char; ?></option>
                        <?php endforeach; ?>
                    </select>


                    <div class="invalid-feedback errorKodeAntrian">

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
        $('.formEdit').submit(function(e) {
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

                        if (response.error.nama_dokter) {
                            $('#nama_dokter').addClass('is-invalid');
                            $('.errorNamaDokter').html(response.error.nama_dokter);
                        } else {
                            $('#nama_dokter').removeClass('is-invalid');
                            $('.errorNamaDokter').html('');
                        }

                        if (response.error.spesialisasi) {
                            $('#spesialisasi').addClass('is-invalid');
                            $('.errorSpesialisasi').html(response.error.spesialisasi);
                        } else {
                            $('#spesialisasi').removeClass('is-invalid');
                            $('.errorSpesialisasi').html('');
                        }

                        if (response.error.hari_praktek1) {
                            $('#hari_praktek1').addClass('is-invalid');
                            $('.errorHari1').html(response.error.hari_praktek1);
                        } else {
                            $('#hari_praktek1').removeClass('is-invalid');
                            $('.errorHari1').html('');
                        }


                        if (response.error.hari_praktek2) {
                            $('#hari_praktek2').addClass('is-invalid');
                            $('.errorHari2').html(response.error.hari_praktek2);
                        } else {
                            $('#hari_praktek2').removeClass('is-invalid');
                            $('.errorNamaDokter').html('');
                        }

                        if (response.error.jam_buka) {
                            $('#jam_buka').addClass('is-invalid');
                            $('.errorJamBuka').html(response.error.jam_buka);
                        } else {
                            $('#jam_buka').removeClass('is-invalid');
                            $('.errorJamBuka').html('');
                        }

                        if (response.error.jam_tutup) {
                            $('#jam_tutup').addClass('is-invalid');
                            $('.errorJamTutup').html(response.error.jam_tutup);
                        } else {
                            $('#jam_tutup').removeClass('is-invalid');
                            $('.errorJamTutup').html('');
                        }

                        if (response.error.kd_antrian) {
                            $('#kd_antrian').addClass('is-invalid');
                            $('.errorKodeAntrian').html(response.error.kd_antrian);
                        } else {
                            $('#kd_antrian').removeClass('is-invalid');
                            $('.errorKodeAntrian').html('');
                        }
                    } else(
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success,
                        }),
                        $('#editModalShow').modal('hide'), location.reload()
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