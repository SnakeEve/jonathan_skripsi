<main role="main">
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <div class="form-group">
                    <input type="text" name="btnSearch" id="btnSearch" class="form-control" placeholder="SEARCH HERE!">
                </div>
            </div>
        </div>
    </div>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row" id="data_container_location"></div>
        </div>
    </div>
</main>

<script>
    var univ_id = "<?php echo  isset($_GET['univ_id'])? $_GET['univ_id']:"";?>";
    var url="";
    if(univ_id==""){
        url = url_local_project_root + "/api/mahasiswa/jurusan.php?apiname=list_perguruan_tinggi_jurusan";
    } else {
        url = url_local_project_root + "/api/mahasiswa/jurusan.php?apiname=list_perguruan_tinggi_jurusan&univ_id=" + univ_id;
    }

    $(document).ready(function(){
        request_list();

        $("#btnSearch").on("keyup change", function(e){
            request_list($(this).val());
        });
    });

    function request_list(search_string_parameter){
        var search_string_object = {};

        if(search_string_parameter != null || search_string_parameter != ''){
            if(univ_id==""){
                search_string_object = {
                    nama: search_string_parameter
                };
            }
            else{
                search_string_object = {
                    nama: search_string_parameter,
                    univ_id: univ_id
                };
            }
            
        }

        $.ajax({
            url: url,
            // type: "GET",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(search_string_object),
            success: function(result){
                let html_output_string = "";

                if(result.data.list.length > 0){
                    $.each(result.data.list, function( index, value ) {
                        html_output_string += '' +
                        '<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4 ">' +
                        '   <div class="card" style="width: 22rem;">' +
                        '       <img class="card-img-top img-responsive mx-auto d-block p-4" data-src="'+ value.foto +'" src="'+ value.foto +'" style="height: 220px; width: 100%; display: block;" alt="no image" data-holder-rendered="true">' +
                        '       <div class="card-body">' +
                        '           <h6 class="card-title">' +
                        '               <div class="row">' +
                        // '                   <div class="col-md-3">' +
                        // '                       <img data-src="'+ value.foto +'" class="img-thumbnail" src="'+ value.foto +'" style="width: 50px; height: 50px;" alt="no image" data-holder-rendered="true">' +
                        // '                   </div>' +
                        '                   <div class="col-md-9">' +
                        '                       <p> '+value.nama_perguruan_tinggi + '</p>' +
                        '                   </div>' +
                        '                   <div class="col-md-9">' +
                                                value.nama + 
                        '                   </div>' +
                        '               </div>' +
                        '           </h6>' +
                        '           <p class="card-text">' + truncate_elipsis(value.description) + '</p>' +
                        '           <a href="index.php?page=detail_jurusan&jurusan_id='+value.id+'&univ_id='+univ_id+'" class="btn btn-primary float-right">Selengkapnya</a>' +
                        '       </div>' +
                        '   </div>' +
                        '</div>';
                    });
                }
                
                html_output_string = html_output_string.trim();

                $("#data_container_location").empty().append(html_output_string);
            },
            error: function(data){
                console.log(data);
            }
        });
    }
</script>