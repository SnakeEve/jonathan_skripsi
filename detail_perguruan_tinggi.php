<main role="main">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row" id="data_detail_container"></div>
        </div>
    </div>
</main>

<script>
    var univ_id = "<?php echo $_GET['univ_id'];?>";
    $(document).ready(function(){
        if(univ_id != null || univ_id != ''){
            $.ajax({
                url: url_local_project_root + "/api/mahasiswa/perguruan_tinggi.php?apiname=detail&id=" + univ_id,
                type: "GET",
                dataType: "json",
                success: function(result){
                    let html_output_string = "";

                    let html_list_fasilitas_string = "";
                    $.each(result.data.list_fasilitas, function( index, value ) {
                        html_list_fasilitas_string += '' +
                        (index == 0 ? '<div class="carousel-item active">' : '<div class="carousel-item">') + 
                        '<img class="d-block w-100" data-src="' + value.foto + '" alt="no image" src="' + value.foto + '" data-holder-rendered="true" style="max-height:1280px;">' +
                        '</div>';
                    });

                    html_output_string += '' +
                    '<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">' +
                    '   <div class="carousel-inner">' +
                            html_list_fasilitas_string +
                    '   </div>' +
                    '</div>';

                    let program_studi_accordion_string = "";
                    program_studi_accordion_string += '<div id="accordion" class="accordion">' +
                    '<div class="card mb-0">';
                    $.each(result.data.list_program_studi, function( index, value ) {
                        let program_studi_jurusan_string = "";
                        $.each(value.list_jurusan, function( index2, value2 ) {
                            program_studi_jurusan_string += '' +
                            '<tr>' +
                            '   <td>' + value2.nama_jurusan + '</td>' +
                            '   <td>' + value2.akreditasi + '</td>' +
                            '   <td>' + value2.kelas + '</td>' +
                            '   <td>' + value2.biaya_per_semester + '</td>' +
                            '   <td>' + value2.biaya_masuk + '</td>' +
                            '</tr>';
                        });

                        program_studi_accordion_string += '' +
                        '<div class="card-header collapsed" data-toggle="collapse" href="#fakultas_'+index+'">' +
                        '   <a class="card-title">' +
                                value.nama_fakultas +
                        '   </a>' +
                        '</div>' +
                        '<div id="fakultas_'+index+'" class="card-body collapse" data-parent="#accordion" >' +
                        '   <table class="table table-borderless">' +
                        '       <thead>' +
                        '           <tr>' +
                        '               <th scope="col">Jurusan</th>' +
                        '               <th scope="col">Akreditasi</th>' +
                        '               <th scope="col">Kelas</th>' +
                        '               <th scope="col">Biaya Per semester (Rp)</th>' +
                        '               <th scope="col">Biaya Masuk (Rp)</th>' +
                        '           </tr>' +
                        '       </thead>' +
                        '       <tbody>' +
                                    program_studi_jurusan_string +
                        '       </tbody>' +
                        '   </table>' +
                        '</div>';
                    });
                    program_studi_accordion_string += '</div></div>';

                    let facility_string = "";
                    $.each(result.data.list_fasilitas, function( index, value ) {
                        facility_string += '<div class="col-md-4 mt-3 col-lg-4">' +
                        // '<img class="d-block w-100" data-src="' + value.foto + '" alt="no image" src="' + value.foto + '" data-holder-rendered="true">' +
                        '<h6>' + value.nama + '</h6>' +
                        '<img src="' + value.foto + '" class="img-fluid" alt="no image">' +
                        '</div>';
                    });

                    let ukm_string = "";
                    $.each(result.data.list_ukm, function( index, value ) {
                        ukm_string += '<div class="col-md-4 mt-3 col-lg-4">' +
                        // '<img class="d-block w-100" data-src="' + value.foto + '" alt="no image" src="' + value.foto + '" data-holder-rendered="true">' +
                        '<h6>' + value.nama + '</h6>' +
                        '<img src="' + value.foto + '" class="img-fluid" alt="no image">' +
                        '</div>';
                    });

                    html_output_string += '' +
                    '<div class="container">' +
                    '   <div class="row">' +
                    '       <div class="col-md-12">' +
                    '           <div class="p-4">' +
                    '               <h1 class="text-center">Informasi Umum</h1>' +
                                        result.data.description +
                    '           </div>' +
                    '       </div>' +
                    '   </div>' +
                    '   <div class="row">' +
                    '       <div class="col-md-12">' +
                    '           <div class="p-4">' +
                    '               <h1 class="text-center">Pendaftaran</h1>' +
                                        result.data.pendaftaran +
                    '           </div>' +
                    '       </div>' +
                    '   </div>' +
                    '   <div class="row">' +
                    '       <div class="col-md-12">' +
                    '           <div class="p-4">' +
                    '               <h1 class="text-center">Fakultas dan Jurusan</h1>' +
                    '           </div>' +
                                program_studi_accordion_string +
                    '       </div>' +
                    '   </div>' +
                    '   <div class="row">' +
                    '       <div class="col-md-12">' +
                    '           <div class="p-4">' +
                    '               <h1 class="text-center">Facility</h1>' +
                    '           </div>' +
                    '       </div>' +
                            facility_string +
                    '   </div>' +
                    '   <div class="row">' +
                    '       <div class="col-md-12">' +
                    '           <div class="p-4">' +
                    '               <h1 class="text-center">Unit Kegiatan Mahasiswa</h1>' +
                    '           </div>' +
                    '       </div>' +
                            ukm_string +
                    '   </div>' +
                    '</div>';
                    
                    html_output_string = html_output_string.trim();

                    $("#data_detail_container").empty().append(html_output_string);
                },
                error: function(data){
                    console.log(data);
                }
            });
        }
        
    });

</script>