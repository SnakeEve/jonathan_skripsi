<?php
include "../../config/database.php";

$response = "";

if(isset($_GET['apiname'])){
    $apiname = $_GET['apiname'];
    switch($apiname){
        case 'list':
        // start web service list
        $sql = "SELECT id, nama, is_active
            from program_studi
            where is_active = 'T' 
            order by id";
        $res = runsqltext($sql);
        $list = array();
        if($res->num_rows > 0){
            while ($row = $res->fetch_object()) {
                array_push($list, $row);
            }
        }else{
            $list = null;
        }
        $responseCode = "0000";
        $message = "Sukses";
        // end web service list
        if(strcmp($responseCode, "0000") == 0){
            $params =   [   'responseCode' => $responseCode,
                            'message' => $message,
                            'data' =>[
                                'list' => $list
                            ]
                        ];   
        }else{
            $params =   [   'responseCode' => $responseCode,
                            'message' => $message
                        ];  
        }
        break;
        case 'get_all_list':
        // start web service list
        $sql = "SELECT id, nama, is_active
            from program_studi
            order by id";
        $res = runsqltext($sql);
        $list = array();
        if($res->num_rows > 0){
            while ($row = $res->fetch_object()) {
                array_push($list, $row);
            }
        }else{
            $list = null;
        }
        $responseCode = "0000";
        $message = "Sukses";
        // end web service list
        if(strcmp($responseCode, "0000") == 0){
            $params =   [   'responseCode' => $responseCode,
                            'message' => $message,
                            'data' =>[
                                'list' => $list
                            ]
                        ];   
        }else{
            $params =   [   'responseCode' => $responseCode,
                            'message' => $message
                        ];  
        }
        break;
        case 'insert':
        // start web service insert
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $nama = $data['nama'];

            $sqlCekProgramStudi = "SELECT id FROM program_studi
                WHERE nama = '$nama' ";
            $res = runSQLtext($sqlCekProgramStudi);

            if($res->num_rows > 0) {
                $responseCode = "0001";
                $message = "Program Studi sudah terdaftar";
            } else {
                $sql = "INSERT into program_studi (nama, is_active) VALUES ('$nama', 'T') ";
                runSQLtext($sql);
                $responseCode = "0000";
                $message = "Sukses";
            }
            
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Insert";
        }
        // end web service insert
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
            $nama = $data['nama'];

            $sqlCekPerguruanTinggi = "SELECT id FROM program_studi
                WHERE nama = '$nama' and id <> $id ";
            $res = runSQLtext($sqlCekPerguruanTinggi);

            if($res->num_rows > 0) {
                $responseCode = "0001";
                $message = "Program studi sudah terdaftar";
            } else {
                $sql = "UPDATE program_studi SET nama='$nama' WHERE id = $id ";
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
            $sql = "SELECT id, nama from program_studi
                where id = $id " ;
            $res = runsqltext($sql);
            if($res->num_rows > 0){
                $row = $res->fetch_assoc();
                $id = $row['id'];
                $nama = $row['nama'];
                
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
                                'nama' => $nama
                            ]
                        ];   
        }else{
            $params =   [   'responseCode' => $responseCode,
                            'message' => $message
                        ];  
        }
        break;
        case 'delete':
        // start web service delete
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $id = $data['id'];

            $sql = "UPDATE program_studi SET is_active = 'F' WHERE id = $id ";
            runSQLtext($sql);
            $responseCode = "0000";
            $message = "Sukses";
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Delete";
        }
        // end web service delete
        $params =   [   'responseCode' => $responseCode,
                        'message' => $message,
                        'data' =>[
                            'body' => json_decode($body, true)
                        ]
                    ];
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