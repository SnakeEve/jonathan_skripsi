<?php
include "../../config/database.php";

$response = "";

if(isset($_GET['apiname'])){
    $apiname = $_GET['apiname'];
    switch($apiname){
        case 'get_all_list':
        // start web service list
        $sql = "SELECT
                    j.id, 
                    j.id_program_studi, 
                    ps.nama AS nama_program_studi,
                    j.nama AS nama_jurusan
                FROM jurusan AS j
                JOIN program_studi AS ps ON j.id_program_studi = ps.id
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
        case 'get_all_list_by_program_studi':
            $programStudiID = $_GET['program_studi_id'];
            // start web service list
            $sql = "SELECT
                        j.id, 
                        j.id_program_studi, 
                        j.nama AS nama_jurusan, 
                        j.description AS description_jurusan, 
                        j.foto AS foto_jurusan, 
                        j.is_active
                    FROM jurusan AS j
                    LEFT JOIN program_studi AS ps 
                    ON j.id_program_studi = ps.id 
                    WHERE ps.id = $programStudiID
                    and j.is_active = 'T' ";
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
        case 'get_all_list_by_university':
            $perguruanTinggi = $_GET['id_perguruan_tinggi'];
            // start web service list
            $sql = "SELECT
                    jk.id, 
                    jk.id_perguruan_tinggi, 
                    pt.nama AS nama_perguruan_tinggi,
                    ps.id AS id_program_studi,
                    ps.nama AS nama_program_studi,
                    jk.id_jurusan, 
                    j.nama AS nama_jurusan,
                    jk.biaya_masuk, 
                    jk.biaya_per_semester, 
                    jk.akreditasi, 
                    jk.kelas, 
                    jk.is_active
                FROM
                    jurusan_kuliah AS jk
                LEFT JOIN jurusan AS J
                ON j.id = jk.id
                LEFT JOIN program_studi AS ps
                ON j.id_program_studi = ps.id
                LEFT JOIN perguruan_tinggi AS pt
                ON pt.id = jk.id
                WHERE jk.id_perguruan_tinggi = $perguruanTinggi";
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
            $id_program_studi = $data['id_program_studi'];
            $nama = $data['nama'];
            $description = $data['description'];

            $sqlCekJurusan = "SELECT id FROM jurusan
                WHERE nama = '$nama' and id_program_studi = $id_program_studi ";
            $res = runSQLtext($sqlCekJurusan);

            if($res->num_rows > 0) {
                $responseCode = "0001";
                $message = "Program Studi sudah terdaftar";
            } else {
                $sql = "INSERT into jurusan (nama, id_program_studi, description, is_active) 
                VALUES ('$nama', $id_program_studi, '$description' ,'T') ";
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
            $id_program_studi = $data['id_program_studi'];
            $nama = $data['nama'];
            $description = $data['description'];

            $sqlCekPerguruanTinggi = "SELECT id FROM jurusan
                WHERE nama = '$nama' and id_program_studi = $id_program_studi and id <> $id ";
            $res = runSQLtext($sqlCekPerguruanTinggi);

            if($res->num_rows > 0) {
                $responseCode = "0001";
                $message = "Program studi sudah terdaftar";
            } else {
                $sql = "UPDATE jurusan SET nama='$nama', description = '$description', id_program_studi =  $id_program_studi
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
            $sql = "SELECT j.id, j.nama, j.description, ps.nama as nama_program_studi, j.foto
                from jurusan j
                join program_studi ps on ps.id = j.id_program_studi
                where j.id = $id " ;
            $res = runsqltext($sql);
            if($res->num_rows > 0){
                $row = $res->fetch_assoc();
                $id = $row['id'];
                $nama = $row['nama'];
                $description = $row['description'];
                $nama_program_studi = $row['nama_program_studi'];
                $foto = $row['foto'];
                
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
                                'nama_program_studi' => $nama_program_studi,
                                'foto' => $foto,
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

            $sql = "UPDATE jurusan SET is_active = 'F' WHERE id = $id ";
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
        case 'detailMataKuliah':
        // start web service detailMataKuliah
        if(isset($_GET['id_jurusan'])){
            $id_jurusan = $_GET['id_jurusan'];
            $sql = "SELECT id,nama
                from mata_kuliah
                where id_jurusan = $id_jurusan 
                order by id" ;
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
            $message = "Missing Request for Detail";
        }
        // end web service detailMataKuliah
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
        case 'deleteMataKuliah':
        // start web service deleteMataKuliah
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $id_mata_kuliah = $data['id_mata_kuliah'];
            $sql = "DELETE from mata_kuliah WHERE id = $id_mata_kuliah ";
            runSQLtext($sql);
            $responseCode = "0000";
            $message = "Sukses";
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Delete Mata Kuliah";
        }
        // end web service deleteMataKuliah
        $params =   [   'responseCode' => $responseCode,
                        'message' => $message,
                        'data' =>[
                            'body' => json_decode($body, true)
                        ]
                    ];
        break;
        case 'addMataKuliah':
        // start web service addMataKuliah
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $id_jurusan = $data['id_jurusan'];
            $nama = $data['nama'];

            $sqlCekFasilitas = "SELECT id FROM mata_kuliah
                WHERE nama = '$nama' and id_jurusan = $id_jurusan ";
            $res = runSQLtext($sqlCekFasilitas);

            if($res->num_rows > 0) {
                $responseCode = "0002";
                $message = "Mata Kuliah sudah Terdaftar";
            } else {
                $sql = "INSERT into mata_kuliah (id_jurusan, nama)
                VALUES ($id_jurusan, '$nama') ";
                runSQLtext($sql);

                $responseCode = "0000";
                $message = "Sukses";
            }
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Add Mata Kuliah";
        }
        // end web service addMataKuliah
        $params =   [   'responseCode' => $responseCode,
                        'message' => $message,
                        'data' =>[
                            'body' => json_decode($body, true)
                        ]
                    ];
        break;
        case 'detailProspekJurusan':
        // start web service detail prospek jurusan
        if(isset($_GET['id_jurusan'])){
            $id_jurusan = $_GET['id_jurusan'];
            $sql = "SELECT id,nama_prospek, keterangan
                from prospek_jurusan
                where id_jurusan = $id_jurusan 
                order by id" ;
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
            $message = "Missing Request for Detail Prospek Jurusan";
        }
        // end web service detail prospek jurusan
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
        case 'deleteProspekJurusan':
        // start web service deleteProspekJurusan
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $id_prospek_jurusan = $data['id_prospek_jurusan'];
            $sql = "DELETE from prospek_jurusan WHERE id = $id_prospek_jurusan ";
            runSQLtext($sql);
            $responseCode = "0000";
            $message = "Sukses";
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Delete Prospek Jurusan";
        }
        // end web service deleteProspekJurusan
        $params =   [   'responseCode' => $responseCode,
                        'message' => $message,
                        'data' =>[
                            'body' => json_decode($body, true)
                        ]
                    ];
        break;
        case 'addProspekJurusan':
        // start web service addProspekJurusan
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $id_jurusan = $data['id_jurusan'];
            $nama_prospek = $data['nama_prospek'];
            $keterangan = $data['keterangan'];

            $sqlCekFasilitas = "SELECT id FROM prospek_jurusan
                WHERE nama_prospek = '$nama_prospek' and id_jurusan = $id_jurusan ";
            $res = runSQLtext($sqlCekFasilitas);

            if($res->num_rows > 0) {
                $responseCode = "0002";
                $message = "Prospek Jurusan sudah Terdaftar";
            } else {
                $sql = "INSERT into prospek_jurusan (id_jurusan, nama_prospek, keterangan)
                VALUES ($id_jurusan, '$nama_prospek', '$keterangan') ";
                runSQLtext($sql);

                $responseCode = "0000";
                $message = "Sukses";
            }
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Add Prospek Jurusan";
        }
        // end web service addProspekJurusan
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