<?php
include "../../config/database.php";

$response = "";

if(isset($_GET['apiname'])){
    $apiname = $_GET['apiname'];
    switch($apiname){
        case 'list':
            // start web service list
            $sql = "SELECT j.id, j.nama, j.description, j.foto,  ps.nama as nama_program_studi
                from jurusan j
                join program_studi ps on ps.id = j.id_program_studi
                where j.is_active = 'T' 
                order by j.id";
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
        case 'list_perguruan_tinggi_jurusan':
            if(isset($_GET['univ_id'])){
                $univ_id = $_GET['univ_id'];
                // start web service list
                $sql = "SELECT j.id, j.nama, j.description, j.foto, ps.nama as nama_program_studi
                        FROM jurusan_kuliah jk
                        LEFT JOIN jurusan j
                        ON j.id = jk.id_jurusan
                        LEFT JOIN program_studi ps
                        ON ps.id = j.id_program_studi
                        WHERE j.is_active = 'T' 
                        AND jk.id_perguruan_tinggi = $univ_id";
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
            }
            break;
        case 'detail':
            // start web service detail
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sql = "SELECT j.id, j.nama, j.description, j.foto,  ps.nama as nama_program_studi
                    from jurusan j
                    join program_studi ps on ps.id = j.id_program_studi
                    where j.is_active = 'T' 
                    and j.id = $id
                    order by j.id" ;
                $res = runsqltext($sql);
                if($res->num_rows > 0){
                    $row = $res->fetch_assoc();
                    $id = $row['id'];
                    $nama = $row['nama'];
                    $description = $row['description'];
                    $foto = $row['foto'];

                    $sqlMataKuliah = "SELECT id, nama
                        from mata_kuliah
                        where id_jurusan = $id
                        order by id";
                    $res2 = runsqltext($sqlMataKuliah);
                    $list_mata_kuliah = array();
                    if($res2->num_rows > 0){
                        while ($row2 = $res2->fetch_object()) {
                            array_push($list_mata_kuliah, $row2);
                        }
                    }else{
                        $list_mata_kuliah = null;
                    }

                    $sqlProspekJurusan = "SELECT id, nama_prospek, keterangan
                        from prospek_jurusan
                        where id_jurusan = $id
                        order by id";
                    $res3 = runsqltext($sqlProspekJurusan);
                    $list_prospek_jurusan = array();
                    if($res3->num_rows > 0){
                        while ($row3 = $res3->fetch_object()) {
                            array_push($list_prospek_jurusan, $row3);
                        }
                    }else{
                        $list_prospek_jurusan = null;
                    }
                    
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
                                    'description' => $description,
                                    'foto' => $foto,
                                    'list_mata_kuliah' => $list_mata_kuliah,
                                    'list_prospek_jurusan' => $list_prospek_jurusan
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