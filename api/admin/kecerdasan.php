<?php
include "../../config/database.php";

$response = "";

if(isset($_GET['apiname'])){
    $apiname = $_GET['apiname'];
    switch($apiname){
        case 'list':
        // start web service list
        $sql = "SELECT id, kode, nama, keterangan
            from kecerdasan
            order by kode";
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
            $kode = $data['kode'];
            $keterangan = $data['keterangan'];

            $sqlCekKecerdasan = "SELECT id FROM kecerdasan
                WHERE kode = '$kode'";
            $res = runSQLtext($sqlCekKecerdasan);

            if($res->num_rows > 0) {
                $responseCode = "0001";
                $message = "Kecerdasan sudah terdaftar";
            } else {
                $sql = "INSERT into kecerdasan (nama, kode, keterangan) 
                VALUES ('$nama', '$kode', '$keterangan') ";
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
            $kode = $data['kode'];
            $keterangan = $data['keterangan'];

            $sqlCekKecerdasan = "SELECT id FROM kecerdasan
                WHERE kode = '$kode' and id <> $id ";
            $res = runSQLtext($sqlCekKecerdasan);

            if($res->num_rows > 0) {
                $responseCode = "0001";
                $message = "Kecerdasan sudah terdaftar";
            } else {
                $sql = "UPDATE kecerdasan SET nama='$nama', kode = '$kode', keterangan =  '$keterangan'
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
            $sql = "SELECT id, nama, kode, keterangan
                from kecerdasan
                where id = $id " ;
            $res = runsqltext($sql);
            if($res->num_rows > 0){
                $row = $res->fetch_assoc();
                $id = $row['id'];
                $nama = $row['nama'];
                $kode = $row['kode'];
                $keterangan = $row['keterangan'];
                
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
                                'kode' => $kode,
                                'keterangan' => $keterangan,
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

            $sql = "DELETE FROM kecerdasan WHERE id = $id ";
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
        case 'detailReferensiJurusan':
        // start web service detailReferensiJurusan
        if(isset($_GET['id_kecerdasan'])){
            $id_kecerdasan = $_GET['id_kecerdasan'];
            $sql = "SELECT rk.id, j.nama
                from referensi_kecerdasan rk
                join jurusan j on j.id = rk.id_jurusan
                where rk.id_kecerdasan = $id_kecerdasan 
                order by j.id" ;
            $res = runsqltext($sql);
            $list = array();
            if($res->num_rows > 0){
                while ($row = $res->fetch_object()) {
                    array_push($list, $row);
                }
                $responseCode = "0000";
                $message = "Sukses";
            }else{
                $responseCode = "0001";
                $message = "Data Tidak Ditemukan";
            }
        } else {
            $responseCode = "0009";
            $message = "Missing Request for Detail Referensi Jurusan";
        }
        // end web service detailReferensiJurusan
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
        case 'deleteReferensiJurusan':
        // start web service deleteReferensiJurusan
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $id_referensi_jurusan = $data['id_referensi_jurusan'];
            $sql = "DELETE from referensi_kecerdasan WHERE id = $id_referensi_jurusan ";
            runSQLtext($sql);
            $responseCode = "0000";
            $message = "Sukses";
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Delete Mata Kuliah";
        }
        // end web service deleteReferensiJurusan
        $params =   [   'responseCode' => $responseCode,
                        'message' => $message,
                        'data' =>[
                            'body' => json_decode($body, true)
                        ]
                    ];
        break;
        case 'addReferensiJurusan':
        // start web service addReferensiJurusan
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $id_jurusan = $data['id_jurusan'];
            $id_kecerdasan = $data['id_kecerdasan'];

            $sqlCekReferensiJurusan = "SELECT id FROM referensi_kecerdasan
                WHERE id_jurusan = $id_jurusan and id_kecerdasan = $id_kecerdasan ";
            $res = runSQLtext($sqlCekReferensiJurusan);
            if($res->num_rows > 0) {
                $responseCode = "0002";
                $message = "Referensi Jurusan sudah Terdaftar";
            } else {
                $sql = "INSERT into referensi_kecerdasan (id_jurusan, id_kecerdasan)
                VALUES ($id_jurusan, $id_kecerdasan) ";
                runSQLtext($sql);

                $responseCode = "0000";
                $message = "Sukses";
            }
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Add Referensi Jurusan";
        }
        // end web service addReferensiJurusan
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