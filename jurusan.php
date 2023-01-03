<main role="main">
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
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
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
                                                value.nama + 
                        '                   </div>' +
                        '               </div>' +
                        '           </h6>' +
                        '           <p class="card-text">' + truncate_elipsis(value.description) + '</p>' +
                        '           <a href="index.php?page=detail_jurusan&jurusan_id='+value.id+'" class="btn btn-primary float-right">Selengkapnya</a>' +
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
    });
</script>