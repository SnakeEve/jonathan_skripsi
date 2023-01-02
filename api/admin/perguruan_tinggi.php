<?php
include "../../config/database.php";

$response = "";

if(isset($_GET['apiname'])){
    $apiname = $_GET['apiname'];
    switch($apiname){
        case 'list':
        // start web service list
        $sql = "SELECT id, nama, description, foto, website, no_telp, akreditasi, email
            from perguruan_tinggi
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
        case 'insert':
        // start web service insert
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $nama = $data['nama'];
            $description = $data['description'];
            $website = $data['website'];
            $no_telp = $data['no_telp'];
            $akreditasi = $data['akreditasi'];
            $email = $data['email'];

            $sqlCekPerguruanTinggi = "SELECT id FROM perguruan_tinggi
                WHERE nama = '$nama' ";
            $res = runSQLtext($sqlCekPerguruanTinggi);

            if($res->num_rows > 0) {
                $responseCode = "0001";
                $message = "Perguruan tinggi sudah terdaftar";
            } else {
                $sql = "INSERT into perguruan_tinggi (nama, description, website, no_telp, akreditasi, email, is_active)
                VALUES ('$nama', '$description', '$website', '$no_telp', '$akreditasi', '$email', 'T') ";
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
            $description = $data['description'];
            $website = $data['website'];
            $no_telp = $data['no_telp'];
            $akreditasi = $data['akreditasi'];
            $email = $data['email'];

            $sqlCekPerguruanTinggi = "SELECT id FROM perguruan_tinggi
                WHERE nama = '$nama' ";
            $res = runSQLtext($sqlCekPerguruanTinggi);

            if($res->num_rows > 0) {
                $responseCode = "0001";
                $message = "Perguruan tinggi sudah terdaftar";
            } else {
                $sql = "UPDATE perguruan_tinggi SET nama='$nama', description='$description', website='$website', 
                        no_telp='$no_telp',  akreditasi='$akreditasi',  email='$email'
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
            $sql = "SELECT id, nama, description, foto, website, no_telp, akreditasi, email
                from perguruan_tinggi
                where is_active = 'T' 
                and id = $id
                order by id" ;
            $res = runsqltext($sql);
            if($res->num_rows > 0){
                $row = $res->fetch_assoc();
                $id = $row['id'];
                $nama = $row['nama'];
                $description = $row['description'];
                $foto = $row['foto'];
                $website = $row['website'];
                $no_telp = $row['no_telp'];
                $akreditasi = $row['akreditasi'];
                $email = $row['email'];
                
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
                                'website' => $website,
                                'no_telp' => $no_telp,
                                'akreditasi' => $akreditasi,
                                'email' => $email
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

            $sql = "UPDATE perguruan_tinggi SET is_active = 'F' WHERE id = $id ";
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
        case 'detailProgramStudi':
        // start web service detailProgramStudi
        if(isset($_GET['id_perguruan_tinggi'])){
            $id_perguruan_tinggi = $_GET['id_perguruan_tinggi'];

            $sqlProgramStudi = "SELECT ps.id as id_fakultas, ps.nama as nama_fakultas 
                from jurusan_kuliah jk
                join jurusan j on j.id = jk.id_jurusan
                join program_studi ps on ps.id = j.id_program_studi
                where jk.id_perguruan_tinggi = $id_perguruan_tinggi
                and jk.is_active = 'T'
                group by ps.id, nama_fakultas
                order by ps.id";
            $res2 = runsqltext($sqlProgramStudi);
            $list = array();
            if($res2->num_rows > 0){
                while ($row2 = $res2->fetch_object()) {
                    //get jurusan
                    $sqlJurusan = "SELECT jk.id as id_jurusan_kuliah, j.id as id_jurusan, j.nama as nama_jurusan, 
                        jk.akreditasi, jk.kelas, jk.biaya_masuk, jk.biaya_per_semester
                        from jurusan_kuliah jk
                        join jurusan j on j.id = jk.id_jurusan
                        join program_studi ps on ps.id = j.id_program_studi
                        where jk.id_perguruan_tinggi = $id_perguruan_tinggi
                        and jk.is_active = 'T'
                        and ps.id = $row2->id_fakultas
                        order by jk.id";
                    $res_jurusan = runsqltext($sqlJurusan);
                    $list_jurusan = array();
                    if($res_jurusan->num_rows > 0){
                        while ($row_jurusan = $res_jurusan->fetch_object()) {
                            array_push($list_jurusan, $row_jurusan);
                        }
                    }else {
                        $list_jurusan = null;
                    }
                    $row2->list_jurusan = $list_jurusan;
                    array_push($list, $row2);
                }
                $responseCode = "0000";
                $message = "Sukses";
            }else{
                $responseCode = "0001";
                $message = "Data tidak ditemukan";
            }
        } else {
            $responseCode = "0009";
            $message = "Missing Request for Detail Program Studi";
        }
        // end web service detailProgramStudi
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
        case 'deleteProgramStudi':
        // start web service deleteProgramStudi
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $id_jurusan_kuliah = $data['id_jurusan_kuliah'];

            $sql = "UPDATE jurusan_kuliah SET is_active = 'F' WHERE id = $id_jurusan_kuliah ";
            runSQLtext($sql);
            $responseCode = "0000";
            $message = "Sukses";
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Delete Program Studi";
        }
        // end web service deleteProgramStudi
        $params =   [   'responseCode' => $responseCode,
                        'message' => $message,
                        'data' =>[
                            'body' => json_decode($body, true)
                        ]
                    ];
        break;
        case 'addProgramStudi':
        // start web service addProgramStudi
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $id_jurusan = $data['id_jurusan'];
            $id_perguruan_tinggi = $data['id_perguruan_tinggi'];
            $biaya_masuk = $data['biaya_masuk'];
            $biaya_per_semester = $data['biaya_per_semester'];
            $akreditasi = $data['akreditasi'];
            $kelas = $data['kelas'];

            $sqlCekJurusanKuliah = "SELECT id FROM jurusan_kuliah
                WHERE id_jurusan = $id_jurusan and id_perguruan_tinggi = $id_perguruan_tinggi ";
            $res = runSQLtext($sqlCekJurusanKuliah);

            if($res->num_rows > 0) {
                $sql = "UPDATE jurusan_kuliah SET is_active = 'T' WHERE  id_jurusan = $id_jurusan and id_perguruan_tinggi = $id_perguruan_tinggi";
                runSQLtext($sql);
            } else {
                $sql = "INSERT into jurusan_kuliah (id_jurusan, id_perguruan_tinggi, biaya_masuk, biaya_per_semester, akreditasi, kelas, is_active)
                VALUES ($id_jurusan, $id_jurusan, $biaya_masuk, $biaya_per_semester, '$akreditasi', '$kelas', 'T') ";
                runSQLtext($sql);
            }
            $responseCode = "0000";
            $message = "Sukses";
            
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Add Program Studi";
        }
        // end web service addProgramStudi
        $params =   [   'responseCode' => $responseCode,
                        'message' => $message,
                        'data' =>[
                            'body' => json_decode($body, true)
                        ]
                    ];
        break;
        case 'detailFasilitas':
        // start web service detailFasilitas
        if(isset($_GET['id_perguruan_tinggi'])){
            $id_perguruan_tinggi = $_GET['id_perguruan_tinggi'];

            $sqlFasilitas= "SELECT id as id_fasilitas, nama, foto
                from fasilitas
                where id_perguruan_tinggi = $id_perguruan_tinggi
                and is_active = 'T'
                order by id";
            $res = runsqltext($sqlFasilitas);
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
            $message = "Missing Request for Detail Fasilitas";
        }
        // end web service detailFasilitas
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
        case 'deleteFasilitas':
        // start web service deleteFasilitas
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $id_fasilitas = $data['id_fasilitas'];
            $sql = "UPDATE fasilitas SET is_active = 'F' WHERE id = $id_fasilitas ";
            runSQLtext($sql);
            $responseCode = "0000";
            $message = "Sukses";
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Delete Fasilitas";
        }
        // end web service deleteFasilitas
        $params =   [   'responseCode' => $responseCode,
                        'message' => $message,
                        'data' =>[
                            'body' => json_decode($body, true)
                        ]
                    ];
        break;
        case 'addFasilitas':
        // start web service addFasilitas
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $id_perguruan_tinggi = $data['id_perguruan_tinggi'];
            $nama = $data['nama'];;

            $sqlCekFasilitas = "SELECT id FROM fasilitas
                WHERE nama = '$nama' and id_perguruan_tinggi = $id_perguruan_tinggi ";
            $res = runSQLtext($sqlCekFasilitas);

            if($res->num_rows > 0) {
                $sql = "UPDATE fasilitas SET is_active = 'T' WHERE  id_perguruan_tinggi = $id_perguruan_tinggi and nama = '$nama'";
                runSQLtext($sql);
            } else {
                $sql = "INSERT into fasilitas (id_perguruan_tinggi, nama, is_active)
                VALUES ($id_perguruan_tinggi, '$nama', 'T') ";
                runSQLtext($sql);
            }
            $responseCode = "0000";
            $message = "Sukses";
            
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Add Fasilitas";
        }
        // end web service addFasilitas
        $params =   [   'responseCode' => $responseCode,
                        'message' => $message,
                        'data' =>[
                            'body' => json_decode($body, true)
                        ]
                    ];
        break;
        case 'detailUkm':
        // start web service detailUkm
        if(isset($_GET['id_perguruan_tinggi'])){
            $id_perguruan_tinggi = $_GET['id_perguruan_tinggi'];

            $sqlUkm= "SELECT id as id_ukm, nama, foto
                from ukm
                where id_perguruan_tinggi = $id_perguruan_tinggi
                and is_active = 'T'
                order by id";
            $res = runsqltext($sqlUkm);
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
            $message = "Missing Request for Detail UKM";
        }
        // end web service detailUkm
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
        case 'deleteUkm':
        // start web service deleteUkm
        $body = file_get_contents('php://input')."\n";
        if($body != ''){
            $data = json_decode($body, true);
            $id_ukm = $data['id_ukm'];
            $sql = "UPDATE ukm SET is_active = 'F' WHERE id = $id_ukm ";
            runSQLtext($sql);
            $responseCode = "0000";
            $message = "Sukses";
        }else {
            $responseCode = "0009";
            $message = "Missing Request for Delete Ukm";
        }
        // end web service deleteUkm
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