<?= $this->extend('admin/adm_template/template'); ?>

<?= $this->section('adm_content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Admin</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between">
                <div class="col">
                    <h5 class="m-0 font-weight-bold text-primary">Data Admin</h5>
                </div>
                <div class="col text-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#adminModal">
                        Tambah admin
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">

            <!-- set flash data -->
            <?php if (session()->getFlashdata('pesanData')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesanData'); ?>
                </div>
            <?php elseif (session()->getFlashdata('pesanError')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('pesanError'); ?>
                </div>
            <?php endif; ?>
            <div class="row mt-3">
                <div class="table-responsive">
                    <table class="table table-hover" id="table_desa" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">password</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $s = 1; ?>
                            <?php foreach ($dataAdmin as $row) : ?>
                                <tr>
                                    <th scope="row"><?= $s; ?></th>
                                    <td><?= $row['username']; ?></td>
                                    <td><?= $row['password']; ?></td>

                                    <td>
                                        <button type="button" onclick="hapus('<?= $row['admin_id']; ?>')" class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                                <?php $s++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>


            <!-- modal tambah admin -->
            <!-- Button trigger modal -->

            <!-- Modal -->
            <div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="adminModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="/admin/saveAdmin" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="adminModalLabel">Tambah admin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="username" class="col-sm-4 col-form-label">Username</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="username" class="form-control" name="username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-4 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" id="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password2" class="col-sm-4 col-form-label">Ulangi Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" id="password2" class="form-control" name="password2">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                    url: "/admin/hapusAdmin",
                    data: {
                        admin_id: id
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