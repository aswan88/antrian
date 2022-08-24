<?= $this->extend('admin/adm_template/template'); ?>

<?= $this->section('adm_content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pasien</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">PASSWORD</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $s = 1; ?>
                        <?php foreach ($dataPasien as $row) : ?>
                            <tr>
                                <th scope="row"><?= $s; ?></th>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td><?= $row['password']; ?></td>
                                <td> <button type="button" onclick="hapus('<?= $row['pasien_id']; ?>')" class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i> Hapus</button>
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
<script>
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
                    url: "/admin/hapusPasien",
                    data: {
                        pasien_id: id
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