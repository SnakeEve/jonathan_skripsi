<?php
include "../../config/database.php";

$response = "";

if(isset($_GET['apiname'])){
    $apiname = $_GET['apiname'];
    switch($apiname){
        case 'list':
        // start web service list
        $sqlSearchNama = "";
        if(isset($_GET['nama'])){
            $nama = $_GET['nama'];
            $sqlSearchNama  = $sqlSearchNama . "AND upper(nama) like upper('%$nama%') ";
        }
        $sql = "SELECT id, nama, description, foto, website, no_telp, akreditasi, email
            from perguruan_tinggi
            where is_active = 'T' ";
        
        $sqlOrder = "order by id ";
        $sql = $sql . $sqlSearchNama ;
        $sql = $sql . $sqlOrder ;
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

                $sqlProgramStudi = "SELECT ps.id as id_fakultas, ps.nama as nama_fakultas 
                    from jurusan_kuliah jk
                    join jurusan j on j.id = jk.id_jurusan
                    join program_studi ps on ps.id = j.id_program_studi
                    where jk.id_perguruan_tinggi = $id
                    and jk.is_active = 'T'
                    group by ps.id, nama_fakultas
                    order by ps.id";
                $res2 = runsqltext($sqlProgramStudi);
                $list_program_studi = array();
                if($res2->num_rows > 0){
                    while ($row2 = $res2->fetch_object()) {
                        //get jurusan
                        $sqlJurusan = "SELECT jk.id as id_jurusan_kuliah, j.id as id_jurusan, j.nama as nama_jurusan, 
                            jk.akreditasi, jk.kelas, jk.biaya_masuk, jk.biaya_per_semester
                            from jurusan_kuliah jk
                            join jurusan j on j.id = jk.id_jurusan
                            join program_studi ps on ps.id = j.id_program_studi
                            where jk.id_perguruan_tinggi = $id
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
                        array_push($list_program_studi, $row2);
                    }
                }else{
                    $list_program_studi = null;
                }

                $sqlFasilitas= "SELECT id, nama, foto
                    from fasilitas
                    where id_perguruan_tinggi = $id
                    and is_active = 'T'
                    order by id";
                $res3 = runsqltext($sqlFasilitas);
                $list_fasilitas = array();
                if($res3->num_rows > 0){
                    while ($row3 = $res3->fetch_object()) {
                        array_push($list_fasilitas, $row3);
                    }
                }else{
                    $list_fasilitas = null;
                }

                $sqlUkm= "SELECT id, nama, foto
                    from ukm
                    where id_perguruan_tinggi = $id
                    and is_active = 'T'
                    order by id";
                $res4 = runsqltext($sqlUkm);
                $list_ukm = array();
                if($res4->num_rows > 0){
                    while ($row4 = $res4->fetch_object()) {
                        array_push($list_ukm, $row4);
                    }
                }else{
                    $list_ukm = null;
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
                                'website' => $website,
                                'no_telp' => $no_telp,
                                'akreditasi' => $akreditasi,
                                'email' => $email,
                                'list_program_studi' => $list_program_studi,
                                'list_fasilitas' => $list_fasilitas,
                                'list_ukm' => $list_ukm
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