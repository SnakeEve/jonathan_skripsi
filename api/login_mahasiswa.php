<?php
include "../config/database.php";
unset($_SESSION["user"]);
session_start();

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];
    // $user_type = $_POST['user_type'];
    $user_type = "M";
    $sql = "SELECT id, nama, no_hp, agama, tanggal_lahir, tempat_lahir, user_type, jenis_kelamin
        from users
        where email = '$email' and password = '$password' and user_type = '$user_type' 
        and is_active = 'T' ";
    $res = runSQLtext($sql);
    $r = "";
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $id = $row['id'];
        $nama = $row['nama'];
        $no_hp = $row['no_hp'];
        $agama = $row['agama'];
        $tanggal_lahir = $row['tanggal_lahir'];
        $tempat_lahir = $row['tempat_lahir'];
        $user_type = $row['user_type'];
        $jenis_kelamin = $row['jenis_kelamin'];
        
        $responseCode = "0000";
        $message = "Sukses";
    }else{
        $responseCode = "0001";
        $message = "Data Tidak Ditemukan";
    }
}else{
    $responseCode = "0009";
    $message = "Missing Request for Login";
}

// end web service login
if(strcmp($responseCode, "0000") == 0){
    $params =   [   'responseCode' => $responseCode,
                    'message' => $message,
                    'data' =>[
                        'id' => $id,
                        'nama' => $nama,
                        'no_hp' => $no_hp,
                        'agama' => $agama,
                        'tanggal_lahir' => $tanggal_lahir,
                        'tempat_lahir' => $tempat_lahir,
                        'user_type' => $user_type,
                        'jenis_kelamin' => $jenis_kelamin
                    ]
                ];   

    $_SESSION['user'] = $params;

    header('Location: ../index.php');

}else{
    $params =   [   'responseCode' => $responseCode,
                    'message' => $message
                ];  
                var_dump($params);
    header('Location: ../login.php');
}

?>