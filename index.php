<!doctype html>
<html lang="en">
<?php include 'header.php';?>
<body>
    <?php include 'navbar.php';?>
    <?php include 'user_modal.php';?>
    
    <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : 'perguruan_tinggi';

        switch ($page) {
            case "rekomendasi_jurusan":
                include 'rekomendasi_jurusan.php';
                break;
            case "history_rekomendasi":
                include 'history_rekomendasi.php';
                break;
            case "jurusan":
                include 'jurusan.php';
                break;
            case "detail_perguruan_tinggi":
                include 'detail_perguruan_tinggi.php';
                break;
            case "detail_jurusan":
                include 'detail_jurusan.php';
                break;
            case "perguruan_tinggi":
            default:
                include 'perguruan_tinggi.php';
                break;
        }
    
    ?>

    <?php include 'scripts.php';?>
    <?php include 'footer.php';?>
</body>
</html> 