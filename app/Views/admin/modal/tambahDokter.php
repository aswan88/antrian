<!-- Modal Dokter -->
<div class="modal fade" id="tambahModalShow" tabindex="-1" role="dialog" aria-labelledby="tambahModalShowLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalShowLabel">Tambah Data Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('/admin/tambah_dokter', ['class' => 'formTambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">


                <div class="form-group">
                    <label for="sip">SIP</label>
                    <input type="text" name="sip" id="sip" class="form-control" autofocusvalue="<?= old('sip'); ?>">
                    <div class="invalid-feedback errorSIP">

                    </div>
                </div>


                <div class="form-group">
                    <label for="nama_dokter">Nama Lengkap</label>
                    <input type="text" name="nama_dokter" id="nama_dokter" class="form-control" autofocusvalue="<?= old('nama_dokter'); ?>">
                    <div class="invalid-feedback errorNamaDokter">

                    </div>
                </div>


                <div class="form-group">
                    <label for="spesialisasi">Spesialisasi</label>
                    <input type="text" name="spesialisasi" id="spesialisasi" class="form-control" autofocusvalue="<?= old('spesialisasi'); ?>">

                    <div class="invalid-feedback errorSpesialisasi">

                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="hari_praktek1">Hari Awal</label>
                        <select name="hari_praktek1" id="hari_praktek1" class="form-control" autofocusvalue="<?= old('hari_praktek1'); ?>">
                            <option disabled selected> Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
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
                            <option disabled selected> Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>

                        <div class=" invalid-feedback errorHari2">
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="jam_buka">Jam Buka</label>
                        <input type="time" class="form-control" id="jam_buka" name="jam_buka" placeholder="jam buka" autofocusvalue="<?= old('jam_buka'); ?>">

                        <div class=" invalid-feedback errorJamBuka">
                        </div>
                    </div>

                    <div class="form-group col-md-2 pt-5 text-center">
                        <span>s/d</span>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="jam_tutup">Jam Tutup</label>
                        <input type="time" class="form-control" id="jam_tutup" name="jam_tutup" placeholder="jam Tutup" autofocusvalue="<?= old('jam_tutup'); ?>">

                        <div class=" invalid-feedback errorJamTutup">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="kd_antrian">Kode Antrian untuk Dokter</label>
                    <select name="kd_antrian" id="kd_antrian" class="form-control" autofocusvalue="<?= old('kd_antrian'); ?>">
                        <option disabled selected> Pilih Kode</option>
                        <?php foreach (range('A', 'Z') as $char) : ?>
                            <option value="<?= $char; ?>"><?= $char; ?></option>
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
                        $('#tambahModalShow').modal('hide'),
                        location.reload()
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