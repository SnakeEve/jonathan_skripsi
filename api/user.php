<?php
include "../config/database.php";

$response = "";

if(isset($_GET['apiname'])){
    $apiname = $_GET['apiname'];
    switch($apiname){
        case 'register':
        // start web service register
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $email = $data['email'];
            $password = $data['password'];
            $nama = $data['nama'];
            $no_hp = $data['no_hp'];
            $agama = $data['agama'];
            $tempat_lahir = $data['tempat_lahir'];
            $tanggal_lahir = $data['tanggal_lahir'];
            $jenis_kelamin = $data['jenis_kelamin'];

            $sqlCekUser = "SELECT id FROM users
                WHERE email = '$email' ";
            $res = runSQLtext($sqlCekUser);

            if($res->num_rows > 0) {
                $responseCode = "0001";
                $message = "Email sudah terdaftar di akun lain";
            } else {
                $sql = "INSERT into users (nama, no_hp, agama, tempat_lahir, tanggal_lahir, jenis_kelamin, email, password,
                        user_type, is_active, created_date, updated_date)VALUES
                    ('$nama', '$no_hp', '$agama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$email', '$password',
                        'U', 'T', now(), now()) ";
                runSQLtext($sql);
                $responseCode = "0000";
                $message = "Sukses";
            }
            
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Register";
        }
        // end web service register
        $params =   [   'responseCode' => $responseCode,
                        'message' => $message,
                        'data' =>[
                            'body' => json_decode($body, true)
                        ]
                    ];
        break;
        case 'update':
            // start web service update
            $body = file_get_contents('php://input')."\n";
            if($body != ''){
                $data = json_decode($body, true);
                $id = $data['id'];
                $email = $data['email'];
                $password = $data['password'];
                $nama = $data['nama'];
                $no_hp = $data['no_hp'];
                $agama = $data['agama'];
                $tempat_lahir = $data['tempat_lahir'];
                $tanggal_lahir = $data['tanggal_lahir'];
                $jenis_kelamin = $data['jenis_kelamin'];
    
                $sqlCekUser = "SELECT id FROM users
                    WHERE email = '$email' ";
                $res = runSQLtext($sqlCekUser);
    
                if($res->num_rows > 0) {
                    $responseCode = "0001";
                    $message = "Email sudah terdaftar di akun lain";
                } else {
                    $sql = "UPDATE users SET nama='$nama',  no_hp='$no_hp', agama='$agama',  tempat_lahir='$tempat_lahir', 
                            tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', email='$email', password='$password',
                            updated_date = now() where id = $id ";
                    runSQLtext($sql);
                    $responseCode = "0000";
                    $message = "Sukses";
                }
                
            }else {
                $responseCode = "0009";
                $message = "Missing Request for Update";
            }
            // end web service update
            $params =   [   'responseCode' => $responseCode,
                            'message' => $message,
                            'data' =>[
                                'body' => json_decode($body, true)
                            ]
                        ];
            break;
        case 'detail':
        // start web service detail
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT id, nama, no_hp, agama, tanggal_lahir, tempat_lahir, user_type, jenis_kelamin
                from users
                where id = $id " ;
            $res = runsqltext($sql);
            if($res->num_rows > 0){
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
        } else {
            $responseCode = "0009";
            $message = "Missing Request for Detail";
        }
        // end web service detail
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