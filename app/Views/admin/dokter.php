<?= $this->extend('admin/adm_template/template'); ?>

<?= $this->section('adm_content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Dokter</h1>
    </div>
    <!-- <button id="click">Click on this paragraph.</button> -->


    <!-- tabel dokter -->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <div class="row justify-content-between">
                <div class="col-4">
                    <h6 class="m-0 font-weight-bold text-primary">DATA DOKTER</h6>
                </div>

                <div class="col-4 text-right">
                    <div class="my-2"></div>
                    <button type="button" class="btn btn-primary btn-icon-split" id="tambahDokterModal">
                        <span class=" icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <div class="my-2 pl-2 pr-2">
                            <span class="text-white">Tambah Data</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('pesanDokter')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesanDokter'); ?>
                </div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode</th>
                            <th scope="col">SIP</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">SPESIALISASI</th>
                            <th scope="col">HARI PRAKTEK</th>
                            <th scope="col">JAM PRAKTER</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $s = 1; ?>
                        <?php foreach ($dataDokter as $row) : ?>
                            <tr>
                                <th scope="row"><?= $s; ?></th>
                                <td><?= $row['kd_antrian']; ?></td>
                                <td><?= $row['SIP']; ?></td>
                                <td><?= $row['nama_dokter']; ?></td>
                                <td><?= $row['spesialisasi']; ?></td>
                                <td><?= $row['hari_praktek']; ?></td>
                                <td><?= $row['jam_buka']; ?> - <?= $row['jam_tutup'];; ?></td>
                                <td>
                                    <?php if ($row['status'] == 'Buka') : ?>
                                        <span class="text-success font-weight-bold" style="font-size: 9px;">
                                            <i class="fa fa-circle text-success"></i>
                                            <?= $row['status']; ?>
                                        </span>
                                    <?php else : ?>
                                        <span class="text-danger font-weight-bold" style="font-size: 9px;">
                                            <i class="fa fa-circle text-danger"></i>
                                            <?= $row['status']; ?>
                                        </span>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <button type="button" onclick="edit('<?= $row['dokter_id']; ?>')" class="btn btn-success btn-circle btn-sm"> <i class="fas fa-edit"></i></button>
                                    <button type="button" onclick="hapus('<?= $row['dokter_id']; ?>')" class="btn btn-danger btn-circle btn-sm"> <i class="fas fa-trash"></i></button>
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




<!-- view Modal Tambah -->

<div class="modalTambahDokter" style="display: none;"></div>

<!-- view Modal Edit -->

<div class="modalEditDokter" style="display: none;"></div>


<script>
    $(document).ready(function() {

        $("#tambahDokterModal").click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "/admin/modalTambahDokter",
                dataType: "json",
                success: function(response) {
                    $('.modalTambahDokter').html(response.data).show();
                    $('#tambahModalShow').modal('show');
                    // location.reload();
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + throwError);
                }

            })
        });
    });

    function edit(id) {
        $.ajax({
            type: "post",
            url: "/admin/modalEditDokter",
            data: {
                dokter_id: id
            },
            dataType: 'json',
            success: function(response) {
                $('.modalEditDokter').html(response.data).show();
                $('#editModalShow').modal('show');

            },
            error: function(xhr, ajaxOptions, throwError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + throwError);
            }

        })
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus..!!',
            text: `Apakah Anda Ingin menghapus Data Ini`,
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
                    url: "/admin/hapusDokter",
                    data: {
                        dokter_id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success,
                            });
                            location.reload();

                        }
                    },
                    error: function(xhr, ajaxOptions, throwError) {
                        alert(xhr.status + '\n' + xhr.responseText + '\n' + throwError);
                    }

                })
            }
        })
    }
</script>
<?= $this->endSection(); ?>