<!DOCTYPE html>
<html lang="en">
<?php include 'header.php';?>
<?php include 'scripts.php';?>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include 'navbar.php';?>
        <?php include 'sidebar.php';?>
        <?php //include 'user_modal.php';?>
        
        <?php 
            $page = isset($_GET['page']) ? $_GET['page'] : 'universitas';

            switch ($page) {
                //PERGURUAN TINGGI
                case "universitas":
                    include 'universitas.php';
                    break;
                case "program_studi_perguruan_tinggi":
                    include 'program_studi_perguruan_tinggi.php';
                    break;
                case "fasilitas_perguruan_tinggi":
                    include 'fasilitas_perguruan_tinggi.php';
                    break;
                case "ukm_perguruan_tinggi":
                    include 'ukm_perguruan_tinggi.php';
                    break;
                //PROGRAM STUDI
                case "program_studi":
                    include 'program_studi.php';
                    break;
                case "jurusan":
                    include 'jurusan.php';
                    break;
                //USERS
                case "users":
                    include 'users.php';
                    break;
                //KRITERIA
                case "kriteria":
                    include 'kriteria.php';
                    break;
                //SAMPLE
                case "datatable":
                default:
                    include 'datatable.php';
                    break;
            }
        
        ?>
        <?php include 'footer.php';?>
    </div>
</body>
</html> 