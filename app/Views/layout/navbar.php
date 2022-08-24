<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/#welcome">SI KLINIK <span> EVENGILINE BOOTH</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav pl-3  ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">BERANDA <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#profile">PROFILE KLINIK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#jadwal">JADWAL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#dokter">DOKTER</a>
                </li>
                <li class="nav-item">
                    <?php if (!session('email')) : ?>
                        <a class="login-link" href="/home/login">Login</a>
                    <?php else : ?>
                        <p class="text-white p-1 ml-2">| Hi, <?= session('nama'); ?>
                            <a href="/home/logout" class="text-white">(logout)</a>
                        </p>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>