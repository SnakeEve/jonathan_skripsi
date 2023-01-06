<?php
include "../../config/database.php";

$response = "";

if(isset($_GET['apiname'])){
    $apiname = $_GET['apiname'];
    switch($apiname){
        case 'list':
        // start web service list
        $sql = "SELECT id, nama
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
        case 'save':
        // start web service insert
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $id_user = $data['id_user'];
            $tes_kecerdasan = $data['tes_kecerdasan'];
            //insert tes
            $sql = "INSERT into tes_kecerdasan (id_user, created_date, updated_date)
                VALUES ($id_user, now(), now()) ";
            runSQLtext($sql);

            //get last id
            $sqlGetId = "SELECT id FROM tes_kecerdasan WHERE id_user = $id_user ORDER BY id desc limit 1";
            $res = runSQLtext($sqlGetId);
            if ($res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $id_tes = $row['id'];
            }

            foreach($tes_kecerdasan as $soal){
                if (strcmp($soal['jawaban'], "T") == 0) {
                    $id_soal = $soal["id_soal"];
                    //insert tes detail
                    $sqlDetail = "INSERT into detail_tes_kecerdasan (id_tes_kecerdasan, id_soal)
                        VALUES ($id_tes, $id_soal) ";
                    runSQLtext($sqlDetail);
                }
            }

            //hitung hasil
            $sqlCekData = "SELECT id_kecerdasan, COUNT(1) AS total_score
                FROM soal s
                JOIN detail_tes_kecerdasan dt ON dt.id_soal = s.id
                WHERE dt.id_tes_kecerdasan = $id_tes
                GROUP BY id_kecerdasan
                order by total_score desc";
            $res_cek = runsqltext($sqlCekData);
            if($res_cek->num_rows > 0){
                $list_kecerdasan = array();
                while ($row_cek = $res_cek->fetch_object()) {
                    //insert hasil tes
                        $sqlHasil = "INSERT into hasil_tes_kecerdasan (id_tes_kecerdasan, id_kecerdasan, total_point)
                        VALUES ($id_tes, $row_cek->id_kecerdasan, $row_cek->total_score) ";
                        runSQLtext($sqlHasil);
                }
            }

            $responseCode = "0000";
            $message = "Sukses";
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Save";
        }
        // end web service save
        if(strcmp($responseCode, "0000") == 0){
            $params =   [   'responseCode' => $responseCode,
                            'message' => $message
                        ];   
        }else{
            $params =   [   'responseCode' => $responseCode,
                            'message' => $message
                        ];  
        }
        break;
        case 'historyRekomendasi':
        // start web service historyRekomendasi
        if(isset($_GET['id_user'])){
            $id_user = $_GET['id_user'];

            $sqlHistoryRekomendasi = "SELECT k.id, k.nama, k.keterangan, ht.total_point
                FROM  tes_kecerdasan t
                JOIN  hasil_tes_kecerdasan ht ON ht.id_tes_kecerdasan = t.id
                JOIN  kecerdasan k ON k.id = ht.id_kecerdasan
                WHERE 1=1
                AND t.id = (SELECT id FROM tes_kecerdasan WHERE id_user  = $id_user ORDER BY created_date DESC LIMIT 1) 
                ORDER BY ht.total_point desc";
            $res = runsqltext($sqlHistoryRekomendasi);
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
        } else {
            $responseCode = "0009";
            $message = "Missing Request for History Rekomendasi";
        }
        // end web service historyRekomendasi
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
        case 'listJurusanByKecerdasan':
            // start web service listJurusanByKecerdasan
            if(isset($_GET['id_kecerdasan'])){
                $id_kecerdasan = $_GET['id_kecerdasan'];
    
                $sql = "SELECT j.id, j.nama, j.description, ps.nama as nama_program_studi, j.foto
                    FROM kecerdasan k
                    JOIN referensi_kecerdasan rk on rk.id_kecerdasan = k.id
                    JOIN jurusan j on j.id = rk.id_jurusan
                    JOIN program_studi ps on ps.id = j.id_program_studi
                    WHERE 1=1
                    and k.id = $id_kecerdasan
                    ORDER BY j.id asc";
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
            } else {
                $responseCode = "0009";
                $message = "Missing Request for List Jurusan by Kecerdasan";
            }
            // end web service listJurusanByKecerdasan
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