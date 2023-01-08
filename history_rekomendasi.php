<style type="text/css">
.callout {
    padding: 20px;
    margin: 20px 0;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 3px;
    h4 {
        margin-top: 0;
        margin-bottom: 5px;
    }
    p:last-child {
        margin-bottom: 0;
    }
    code {
        border-radius: 3px;
    }
    & + .bs-callout {
        margin-top: -5px;
    }
}
</style>

<main role="main">
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">REKOMENDASI</h3>
                <p class="text-center">Berikut adalah hasil tes anda</p>
                <div id="data_container_location"></div>
            </div>
        </div>

    </div>
</main>


<script>
    var user_id = <?php echo $id; ?>;
    $(document).ready(function(){
        $.ajax({
            url: url_local_project_root + "/api/mahasiswa/tes_kecerdasan.php?apiname=historyRekomendasi&id_user="+user_id,
            type: "GET",
            dataType: "json",
            success: function(result){
                let html_output_string = "";

                $.each(result.data.list, function( index, value ) {
                    if(index == 0){
                        html_output_string += '' +
                            '<h3>Kecerdasan Dominan Anda Adalah</h3>';
                        }

                    html_output_string += '' +
                        '<div class="callout callout-info">' +
                        '   <p>Hasil kategori kecerdasan anda adalah: '+value.nama+'</p>' +
                        '   <p>Keterangan tambahan: '+value.keterangan+'</p>' +
                        '   <p>Total poin kecerdasan anda: '+value.total_point+'</p>' +
                        '   <div class="row">' +
                        '       <div class="col-12">' +
                        '           <div id="jurusan_rekomendasi_container_'+index+'"></div>' +
                        '       </div>' +
                        '   </div>' +
                        '</div>';
                });
                
                html_output_string = html_output_string.trim();
                $("#data_container_location").empty().append(html_output_string);

                $.each(result.data.list, function( index, value ) {
                    $.ajax({
                        url: url_local_project_root + "/api/mahasiswa/tes_kecerdasan.php?apiname=listJurusanByKecerdasan&id_kecerdasan="+value.id,
                        type: "GET",
                        dataType: "json",
                        success: function(result){7
                            let html_output_inner_string = "";

                            html_output_inner_string += '<div class="row">';
                            $.each(result.data.list, function( index, value ) {
                                html_output_inner_string += '' +
                                '<div class="col-4">' + 
                                '   <div class="card mb-2" style="width: 22rem;">' +
                                '       <img class="card-img-top img-responsive mx-auto d-block p-4" data-src="'+ value.foto +'" src="'+ value.foto +'" style="height: 220px; width: 100%; display: block;" alt="no image" data-holder-rendered="true">' +
                                '       <div class="card-body">' +
                                '           <h6 class="card-title">' +
                                '               <div class="row">' +
                                '                   <div class="col-md-9">' +
                                '                       <p> '+value.nama + ' <br> ' +value.nama_program_studi + '</p>' +
                                '                   </div>' +
                                '               </div>' +
                                '           </h6>' +
                                '           <p class="card-text">' + truncate_elipsis(value.description) + '</p>' +
                                '           <a href="index.php?page=detail_jurusan&jurusan_id='+value.id+'" class="btn btn-primary float-right">Selengkapnya</a>' +
                                '       </div>' +
                                '   </div>' + 
                                '</div>';
                            });
                            html_output_inner_string += '</div>';
                            
                            html_output_inner_string = html_output_inner_string.trim();
                            $("#jurusan_rekomendasi_container_"+index).empty().append(html_output_inner_string);
                        },
                        error: function(data){
                            console.log(data);
                        }
                    });
                });

            },
            error: function(data){
                console.log(data);
            }
        });
    });
</script>