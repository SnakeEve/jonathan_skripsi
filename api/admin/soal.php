<?php
include "../../config/database.php";

$response = "";

if(isset($_GET['apiname'])){
    $apiname = $_GET['apiname'];
    switch($apiname){
        case 'list':
        // start web service list
        $sql = "SELECT id, id_kecerdasan, nama, order_seq
            from soal
            order by order_seq";
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
        case 'list_frontend':
            // start web service list
            $sql = "SELECT id, nama, RAND() as rand
                from soal
                order by rand";
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
        case 'list_by_kecerdasan':
            $id_kecerdasan = $_GET['id_kecerdasan'];
            // start web service list
            $sql = "SELECT id, id_kecerdasan, nama 
                from soal where id_kecerdasan = $id_kecerdasan";
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
            $id_kecerdasan = $data['id_kecerdasan'];
            $nama = $data['nama'];

            //validasi
            $sqlCekKecerdasan = "SELECT id FROM soal
                WHERE nama = '$nama' and id_kecerdasan = '$id_kecerdasan' ";
            $resCK = runSQLtext($sqlCekKecerdasan);

            if($resCK->num_rows > 0) {
                $responseCode = "0001";
                $message = "Soal sudah terdaftar";
            }  else {
                $sql = "INSERT into soal (id_kecerdasan, nama) 
                VALUES ($id_kecerdasan, '$nama') ";
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
            $id_kecerdasan = $data['id_kecerdasan'];
            $nama = $data['nama'];

            //validasi
            $sqlCekKecerdasan = "SELECT id FROM soal
                WHERE nama = '$nama' and id_kecerdasan = '$id_kecerdasan' and id <> $id ";
            $resCK = runSQLtext($sqlCekKecerdasan);

            // $sqlCekOrderSeq = "SELECT id FROM soal
            //     WHERE order_seq = $order_seq  and id <> $id ";
            // $resCOS = runSQLtext($sqlCekOrderSeq);

            if($resCK->num_rows > 0) {
                $responseCode = "0001";
                $message = "Soal sudah terdaftar";
            } else {
                $sql = "UPDATE soal SET nama='$nama', id_kecerdasan = $id_kecerdasan 
                    WHERE id = $id ";
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
            $sql = "SELECT s.id, s.nama, k.kode as kode_kecerdasan, s.order_seq
                from soal s
                join kecerdasan k on k.id = s.id_kecerdasan
                where s.id = $id " ;
            $res = runsqltext($sql);
            if($res->num_rows > 0){
                $row = $res->fetch_assoc();
                $id = $row['id'];
                $nama = $row['nama'];
                $kode_kecerdasan = $row['kode_kecerdasan'];
                $order_seq = $row['order_seq'];
                
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
                                'kode_kecerdasan' => $kode_kecerdasan,
                                'order_seq' => $order_seq,
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

            $sql = "DELETE FROM soal WHERE id = $id ";
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