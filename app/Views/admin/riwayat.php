<?= $this->extend('admin/adm_template/template'); ?>

<?= $this->section('adm_content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Antrian</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Antrian</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">No Antrian</th>
                            <th scope="col">Dokter</th>
                            <th scope="col">Tanggal Masuk</th>
                            <th scope="col">Tanggal Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $s = 1; ?>
                        <?php foreach ($dataRiwayat as $row) : ?>
                            <tr>
                                <th scope="row"><?= $s; ?></th>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['no_antrian']; ?></td>
                                <td><?= $row['nama_dokter']; ?></td>
                                <td><?= $row['masuk']; ?></td>
                                <td><?= $row['selesai']; ?></td>
                            </tr>
                            <?php $s++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>