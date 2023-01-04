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
                if (strcmp($soal['answer'], "T") == 0) {
                    echo $soal['id_soal']."\n";
                    //insert tes
                    $sql = "INSERT into detail_tes_kecerdasan (id_user, id_tes_kecerdasan, created_date, updated_date)
                        VALUES ($id_user, now(), now()) ";
                    runSQLtext($sql);
                }
            }
            //$list_jawaban = $data['list_jawaban'];
            $responseCode = "0000";
            $message = "Sukses";
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Insert";
        }
        // end web service insert
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