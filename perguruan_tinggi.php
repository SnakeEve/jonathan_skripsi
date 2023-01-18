<main role="main">
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <div class="form-group">
                    <input type="text" name="btnSearch" id="btnSearch" class="form-control" placeholder="SEARCH HERE!">
                </div>
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="col-lg-5 col-md-5">
                <button type="button" class="btn btn-primary w-100" id="btnPrev">PREV</button>
            </div>
            <div class="col-lg-2 col-md-2">
                <div class="text-center">
                    <div id="print_data_page">1 / 1</div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5">
                <button type="button" class="btn btn-primary w-100" id="btnNext">NEXT</button>
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
    var current_page = 1;
    var total_data = 0;
    var total_page = 0;
    $(document).ready(function(){
        request_list();

        $("#btnSearch").on("keyup change", function(e){
            request_list($(this).val());
        });

        $("#btnPrev").on("click", function(e){
            if(current_page > 1){
                current_page = current_page - 1;
                request_list($('#btnSearch').val());
            }
        });
        
        $("#btnNext").on("click", function(e){
            current_page = current_page + 1;
            request_list($('#btnSearch').val());
        });

    });

    function request_list(search_string_parameter){
        var search_string_object = {};

        if(search_string_parameter != null || search_string_parameter != ''){
            search_string_object = {
                nama: search_string_parameter,
                page: current_page
            };
        }

        $.ajax({
            url: url_local_project_root + "/api/mahasiswa/perguruan_tinggi.php?apiname=list",
            // type: "GET",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(search_string_object),
            success: function(result){
                console.log(result);
                let html_output_string = "";

                total_data = parseInt(result.data.totalData);
                // total_page = parseInt(total_data/12);
                total_page = Math.ceil(total_data/12);

                var totalString = "Total Data: "+total_data +"<br/>" +
                        current_page+" / "+total_page;


                $("#print_data_page").empty().append(totalString);

                if(result.data.list != null && result.data.list.length > 0){
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
                        '           <a href="index.php?page=jurusan&univ_id='+value.id+'" class="btn btn-primary float-left">List Jurusan</a>' +
                        '           <a href="index.php?page=detail_perguruan_tinggi&univ_id='+value.id+'" class="btn btn-primary float-right">Selengkapnya</a>' +
                        '       </div>' +
                        '   </div>' +
                        '</div>';
                    });
                        
                    html_output_string = html_output_string.trim();
                    $("#data_container_location").empty().append(html_output_string);
                }
                else{
                    current_page = current_page - 1;
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    }
</script>