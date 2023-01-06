<main role="main">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row" id="data_container_location"></div>
        </div>
    </div>
</main>

<script>
    var jurusan_id = "<?php echo $_GET['jurusan_id'];?>";
    var univ_id = "<?php echo  isset($_GET['univ_id'])? $_GET['univ_id']:"";?>";
    $(document).ready(function(){
        if(jurusan_id != null || jurusan_id != ''){
            $.ajax({
                url: url_local_project_root + "/api/mahasiswa/jurusan.php?apiname=detail&id=" + jurusan_id,
                type: "GET",
                dataType: "json",
                success: function(result){
                    let html_output_string = "";

                    let mata_kuliah_string = "";
                    $.each(result.data.list_mata_kuliah, function( index, value ) {
                        mata_kuliah_string += '' +
                        '<tr>' +
                        '   <td>' + value.nama + '</td>' +
                        '</tr>' +
                        '';
                    });

                    let prospek_jurusan_string = "";
                    $.each(result.data.list_prospek_jurusan, function( index, value ) {
                        prospek_jurusan_string += '' +
                        '<tr>' +
                        '   <td>' + value.nama_prospek + '</td>' +
                        '   <td>' + value.keterangan + '</td>' +
                        '</tr>' +
                        '';
                    });

                    let perguruan_tinggi_element = "";
                    let perguruan_tinggi_string = "";
                    if(univ_id !=''){
                        $.each(result.data.list_perguruan_tinggi, function( index, value ) {
                            perguruan_tinggi_string += '' +
                            '<tr>' +
                            '   <td>' + value.nama + '</td>' +
                            '   <td>' +
                            '         <img data-src="' +value.foto+ '" alt="no image" src="' +value.foto+ '" data-holder-rendered="true" style="width:100px;height:100px;">' +
                            '   </td>'
                            '</tr>' +
                            '';
                        });
                        perguruan_tinggi_element += '' +
                        '   <div class="row">' +
                        '       <div class="col-md-12">' +
                        '           <div class="p-4">' +
                        '               <h1 class="text-center">Perguruan Tinggi Terdaftar</h1>' +
                        '               <div class="card mb-0">' +
                        '                   <table class="table table-borderless">' +
                                                perguruan_tinggi_string +
                        '                   </table>' +
                        '               </div>' +
                        '           </div>' +
                        '       </div>' +
                        '   </div>' +
                            '';
                    }              


                    html_output_string += '' +
                    '<div class="container">' +
                    '   <div class="row">' +
                    '       <div class="col-md-12">' +
                    '           <div class="p-4">' +
                    '               <img class="d-block w-100" data-src="' +result.data.foto+ '" alt="no image" src="' +result.data.foto+ '" data-holder-rendered="true">' +
                    '           </div>' +
                    '       </div>' +
                    '   </div>' +
                    '</div>' +
                    '<div class="container">' +
                    '   <div class="row">' +
                    '       <div class="col-md-12">' +
                    '           <div class="p-4">' +
                    '               <h1 class="text-center">Deskripsi Jurusan</h1>' +
                                    result.data.description +
                    '           </div>' +
                    '       </div>' +
                    '   </div>' +
                    '   <div class="row">' +
                    '       <div class="col-md-12">' +
                    '           <div class="p-4">' +
                    '               <h1 class="text-center">Mata Kuliah</h1>' +
                    '               <div class="card mb-0">' +
                    '                   <table class="table table-borderless">' +
                                            mata_kuliah_string +
                    '                   </table>' +
                    '               </div>' +
                    '           </div>' +
                    '       </div>' +
                    '   </div>' +
                    '   <div class="row">' +
                    '       <div class="col-md-12">' +
                    '           <div class="p-4">' +
                    '               <h1 class="text-center">Prospek Kerja</h1>' +
                    '               <div class="card mb-0">' +
                    '                   <table class="table table-borderless">' +
                                            prospek_jurusan_string +
                    '                   </table>' +
                    '               </div>' +
                    '           </div>' +
                    '       </div>' +
                    '   </div>' +
                    perguruan_tinggi_element +
                    '</div>';
                    
                    html_output_string = html_output_string.trim();

                    $("#data_container_location").empty().append(html_output_string);
                },
                error: function(data){
                    console.log(data);
                }
            });
        }
        
    });

</script>