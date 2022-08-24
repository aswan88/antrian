<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- jumbotron -->
<section id="welcome" class="welcome">
    <div class="jumbotron-fluid">
        <img src="gambar/web/bg1.jpg" alt="" style="max-height: 45.5rem;">
        <!-- <div class="gradien"></div> -->
        <div class="container">
            <div class="row justify-content-md-center">
                <h1><img src="gambar/web/logo.png" alt="logo bala keselamatan">BALA KESELAMATAN</h1>
            </div>
            <div class="row justify-content-md-center">
                <h2>KLINIK</h2>
                <span>"EVANGELINE BOOTH"</span>
            </div>
            <div class="row justify-content-md-center">
                <p>JL. D. Panjaitan No 48-50 Ambon</p>
            </div>
        </div>
        <div class="btn-daftar">
            <div class="row mt-3 justify-content-center tom-daftar">
                <h3>Daftar Dan Antri Lansung Dari Rumah</h3><br>
            </div>
        </div>
    </div>
</section>

<!-- isi conten -->
<section id="card-jam">
    <div class="row justify-content-center" onload="waktu()">
        <div class="h5 font-weight-bold text-white" id="jam"></div>
    </div>
    <div class="row justify-content-center">
        <div class="text-xs font-weight-bold text-white"><?= date('d F Y'); ?>,</div>
    </div>
</section>
<section id="content-body">

    <?php if (session('status') == 'login') : ?>
        <!-- begian Daftar -->
        <section id="antrian" class="antrian">
            <div class="row justify-content-center">
                <div class="judul">
                    <h2>Antrian</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8  mx-auto pb-4">

                    <?php if (!$antrian) : ?>
                        <div class="alert alert-warning" role="alert">
                            Anda belum Mengambil No Antrian
                        </div>

                        <div class="row justify-content-center">
                            <?php foreach ($dataDokter as $rowD) : ?>
                                <div class="col-xl-3 col-md-3 col-sm-4 mb-4">
                                    <div class="card border-bottom-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row justify-content-between">

                                                <div class="col">
                                                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Loket</div>
                                                </div>

                                                <div class="col">
                                                    <i class="fas fa-users text-gray-300"></i>
                                                    <span class="badge badge-danger badge-counter" style="margin-top: -10rem;" class="counter">0
                                                        <?php foreach ($notif as $n) : ?>
                                                            <?php
                                                            if ($rowD['dokter_id'] == $n['dokter_id']) {
                                                                echo $s = $n['countD'];
                                                            }
                                                            ?>
                                                        <?php endforeach; ?>
                                                    </span>
                                                </div>

                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="h2 mb-0 font-weight-bold text-gray-800 border border-info p-2 mb-4 mt-4"><?= $rowD['kd_antrian']; ?></div>
                                            </div>

                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><?= $rowD['nama_dokter']; ?></div>
                                                    <?php if ($rowD['status'] == 'Buka') : ?>
                                                        <span class="text-success font-weight-bold" style="font-size: 9px;">
                                                            <i class="fa fa-circle text-success"></i> Status:
                                                            <?= $rowD['status']; ?>
                                                        </span>
                                                        <button type="submit" onclick="getNoAntri('<?= $rowD['dokter_id']; ?>', <?= $_SESSION['pasien_id']; ?>)" class="get btn btn-outline-info w-100 text-success" data-id=""><i class="fab fa-get-pocket"></i> Ambil Antrian</button>
                                                    <?php else : ?>
                                                        <span class="text-danger font-weight-bold" style="font-size: 9px;">
                                                            <i class="fa fa-circle text-danger"></i> Status:
                                                            <?= $rowD['status']; ?>
                                                        </span>
                                                        <button type="submit" disabled='disabled' class="get btn btn-outline-info w-100 text-danger" data-id=""><i class="fa fa-times"></i> Belum Di Buka</button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php else : ?>
                        <!-- seting flash data -->
                        <?php if (session()->getFlashdata('pesanAntri')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('pesanAntri'); ?>
                            </div>
                        <?php elseif (session()->getFlashdata('pesanAntri2')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session()->getFlashdata('pesanAntri2'); ?>
                            </div>
                        <?php else : ?>
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="card border-bottom-success shadow h-100 p-2">
                                        <div class="row justify-content-between">
                                            <div class="col">
                                                <div class="text-xl font-weight-bold text-success text-uppercase mb-1">Hallo : <?= $antrian[0]['nama']; ?></div>
                                                <p class="text-success text-sm">No Antri Kamu Adalah</p>
                                                <div class="h2 mb-0 font-weight-bold text-center text-gray-800">
                                                    <?php if ($antrian) : ?>
                                                        <?= $antrian[0]['no_antrian']; ?>
                                                    <?php else : ?>
                                                        Belum Diambil
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <p class="text-info text-sm">Waktu Masukmu Adalah :</p>
                                                <div class="h6 mb-0 font-weight-bold text-center text-gray-800">
                                                    <?= $antrian[0]['prediksi']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card border-bottom-success shadow h-100 p-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase">
                                            Kamu Antri Pada Dokter
                                        </div>

                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= $antrian[0]['nama_dokter']; ?> (<?= $antrian[0]['kd_antrian']; ?>)
                                        </div>
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mt-4">
                                            <i class="fa fa-users"></i> Total Menunggu (<?= $jumlahMenunggu; ?>) ||
                                            <i class="fa fa-users"></i> Total Antrian (<?= $jmlAntrian; ?>)
                                        </div>
                                        <?php if ($antrian[0]['status'] == 'Buka') : ?>
                                            <span class="text-success font-weight-bold" style="font-size: 9px;">
                                                <i class="fa fa-circle text-success"></i> Status:
                                                <?= $antrian[0]['status']; ?>
                                            </span>
                                        <?php else : ?>
                                            <span class="text-danger font-weight-bold" style="font-size: 9px;">
                                                <i class="fa fa-circle text-danger"></i> Status:
                                                <?= $antrian[0]['status']; ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="card border-bottom-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sementara Menunggu</div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-info">
                                                                <?php if (empty(($antTunggu['no_antrian']))) : ?>
                                                                    Belum Ada
                                                                <?php else : ?>
                                                                    <?= $antTunggu['no_antrian']; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="text-xs font-weight-bold text-danger text-uppercase mt-4">
                                                                <i class="fa fa-users"></i> Total Mengantri (<?= $jumlahMenunggu; ?>)
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col">
                                    <div class="card border-bottom-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sementara Proses</div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-info">
                                                                <?php if (empty(($antrianProses['no_antrian']))) : ?>
                                                                    Belum Ada
                                                                <?php else : ?>
                                                                    <?= $antrianProses['no_antrian']; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-auto">
                                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card border-bottom-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Antrian Selesai</div>
                                                    <div class="h5 mb-0 font-weight-bold text-info">
                                                        <?php if (empty(($antrianSelesai['no_antrian']))) : ?>
                                                            Kosong
                                                        <?php else : ?>
                                                            <?= $antrianSelesai['no_antrian'] ?>
                                                        <?php endif; ?><br>

                                                    </div>
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mt-4">
                                                        <i class="fa fa-users"></i> Total Selesai (<?= $JantrianSelesai; ?>)
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-user-check fa-2x text-gray-300"></i>
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
                                                <span class="font-weight-bold">Riwayat Antrian</span>
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
                                                            <th scope="col">DOKTER</th>
                                                            <th scope="col">WAKTU MASUK</th>
                                                            <th scope="col">WAKTU KELUAR</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $s = 1; ?>
                                                        <?php foreach ($riwayat as $row) : ?>
                                                            <tr>
                                                                <th scope="row"><?= $s; ?></th>
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
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php else : ?>

        <!-- bagian Antrian -->

        <section id="antrian" class="antrian">
            <div class="row justify-content-center">
                <div class="judul">
                    <h2>Antrian</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8  mx-auto pb-4">
                    <!-- Page Heading -->
                    <div class="d-sm-flex pt-3 align-items-center justify-content-center mb-4">
                        <img src="gambar/antiran.png" alt="Icon Antrian" class="bg-white rounded-circle" width="150">
                    </div>
                    <div class="d-sm-flex pt-3 align-items-center justify-content-center mb-4">
                        <a href="/home/login" class="btn btn-outline-info bg-danger text-white">Anda Belum login Silahkan Login..!! <br> Untuk Mengambil No Antrian</a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>




    <!-- bagian profile -->
    <section id="profile" class="profile">
        <div class="container">
            <div class="row">
                <div class="row mx-auto">
                    <div class="judul">
                        <h2>Profil Klinik</h2>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-center">Bala Keselamatan (Inggris: Salvation Army. Belanda: Leger des Heils) adalah salah satu denominasi di kalangan Gereja Protestan yang terkenal dengan pelayanan sosialnya. Mereka melaksanakan berbagai program seperti dapur umum untuk kaum miskin, rumah tumpangan, panti asuhan, rumah sakit, proyek-proyek pembangunan masyarakat, dll. Sehari-hari mereka mengenakan pakaian seragam dengan pangkat-pangkat kemiliteran, dari prajurit sampai jenderal.

                            Pimpinan tertinggi Bala Keselamatan se-dunia berpangkat jenderal dan berkedudukan di London, Inggris. Kedudukan ini sekarang dijabat oleh Jenderal André Cox, seorang berkebangsaan Inggris.</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-center">Pelayanan Bala Keselamatan di Indonesia telah berlangsung sejak datangnya dua orang rohaniwan berkebangsaan Belanda pada tanggal 20 November 1894. Mereka tiba di Batavia dan kemudian mulai melayani di Purworejo, Jawa Tengah. Kini pelayanan mereka mencakup lebih kurang 15 provinsi di seluruh Indonesia. Sejumlah program yang dilakukan oleh Bala Keselamatan di Indonesia adalah RSU "William Booth" di Surabaya, RSU "William Booth" di Semarang, RS Ibu dan Anak "Catherine Booth" di Makassar, sejumlah sekolah di Jakarta, Bandung, Jombang, Kulawi (Sulawesi Tengah), Semarang, Kec. Long Iram, Kalimantan Timur, dll.

                            Pimpinan Bala Keselamatan di Indonesia disebut Komandan Teritorial yang berkedudukan di Bandung.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- bagian jadwal -->
    <section id="jadwal">
        <div class="container">
            <div class="row mt-5">
                <div class="row mx-auto pb-4">
                    <div class="judul">
                        <h2>Jadwal Praktek</h2>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">Nama Dokter</th>
                            <th scope="col">SIP</th>
                            <th scope="col">Spesialisasi</th>
                            <th scope="col">Waktu Praktek</th>
                            <th scope="col">Status Antrian</th>
                        </tr>
                    </thead>
                    <?php $no = 1;
                    foreach ($dataDokter as $rowD) : ?>
                        <tbody class="table-light">
                            <tr>
                                <th scope="row"><?= $no; ?></th>
                                <td><?= $rowD['nama_dokter']; ?></td>
                                <td><?= $rowD['SIP']; ?></td>
                                <td><?= $rowD['spesialisasi']; ?></td>
                                <td>
                                    <span>
                                        <?= $rowD['hari_praktek']; ?>
                                    </span><br>
                                    <?= $rowD['jam_buka']; ?> - <?= $rowD['jam_tutup']; ?>
                                </td>
                                <td>
                                    <?php if ($rowD['status'] == 'Buka') : ?> <small>
                                            <i class="fa fa-circle text-success"></i>
                                            <span class="text-success font-weight-bold" style="font-size: 14px;">
                                                <?= $rowD['status']; ?>
                                            </span>

                                        </small>
                                    <?php else : ?>
                                        <small>
                                            <i class="fa fa-circle text-danger"></i>
                                            <span class="text-danger font-weight-bold" style="font-size: 14px;">
                                                <?= $rowD['status']; ?>
                                            </span>

                                        </small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>

                    <?php $no++;
                    endforeach; ?>
                </table>
            </div>
        </div>
    </section>

    <!-- bagian dokter -->
    <section id="dokter" class="dokter">
        <div class="container">
            <div class="row mt-5">
                <div class="row mx-auto pb-4">
                    <div class="judul">
                        <h2>Dokter Klink</h2>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center text-center">
                <?php foreach ($dataDokter as $rowD) : ?>
                    <div class="card" style="width: 16rem; margin-left: 2rem; margin-bottom: 2rem;" class="shadow h-100">
                        <img class="card-img-top" src="gambar/dok.png" alt="Card image cap" style="max-height: 20rem;">
                        <div class="card-body">
                            <div class="row justify-content-md-center text-center">
                                <h6><?= $rowD['nama_dokter']; ?></h6>
                            </div>
                            <div class="row justify-content-md-center text-center">
                                <span><?= $rowD['spesialisasi']; ?></span>
                            </div>
                            <div class="row justify-content-md-center text-center">
                                <p><?= $rowD['SIP']; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-6 justify-content-center">


                </div> -->
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- tutup secction body -->
    <script>
        function test() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "berhasil",
            });
        }

        function getNoAntri(dokter_id, pasien_id) {
            $.ajax({
                type: "post",
                url: "/antrian/getAntrian",
                data: {
                    dokter_id: dokter_id,
                    pasien_id: pasien_id,
                },
                dataType: 'json',
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: response.success,
                        showCancelButton: false,
                        cancelButtonText: 'Oke'
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            // Swal.fire('Tersimpan', '', 'success')
                            Swal.fire('Selesai', '', 'info')
                        } else {
                            Swal.fire('Selesai', '', 'info')
                        }
                        location.reload();
                    })
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + throwError);
                }

            })

        };
    </script>
    <?= $this->endSection(); ?>
</section>


<!-- javascript home -->