<?php
include "../config/database.php";

$response = "";

if(isset($_GET['apiname'])){
    $apiname = $_GET['apiname'];
    switch($apiname){
        case 'login':
        // start web service login customer
        if(isset($_POST['email']) && isset($_POST['password'])){
            $email = strtolower($_POST['email']);
            $password = $_POST['password'];
            $user_type = $_POST['user_type'];
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
        }else{
            $params =   [   'responseCode' => $responseCode,
                            'message' => $message
                        ];  
        }
        break;
        default:
        $responseCode = "0010";
        $message = "Unknown Api Name";
        $params =   [   
            'responseCode' => $responseCode,
            'message' => $message
        ]; 
    }
}else{
    $responseCode = "0011";
    $message = "Missing Request API Name";
    $params =   [   
        'responseCode' => $responseCode,
        'message' => $message
    ]; 
}
$response = json_encode($params);
echo $response;

?>