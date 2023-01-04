<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <img src="assets/logo/logo_icon.png" style="width:50px; height: auto;">
    </h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="index.php?page=perguruan_tinggi">List Perguruan Tinggi</a>
        <a class="p-2 text-dark" href="index.php?page=jurusan">List Jurusan</a>
        <a class="p-2 text-dark" href="index.php?page=history_rekomendasi">History rekomendasi</a>
        <a class="p-2 text-dark" href="index.php?page=rekomendasi_jurusan">Rekomendasi Jurusan</a>
    </nav>
    <button class="btn btn-outline-primary mr-1" id="user_status"><?php echo $nama; ?></button>
    <button class="btn btn-outline-primary" id="logout" onclick="javascript_logout()">LOGOUT</button>
</div>