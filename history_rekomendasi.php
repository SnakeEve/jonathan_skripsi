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
            <div class="col-md-12 text-center">
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

                let data_history = result.data.list[0];

                html_output_string += '' +
                    '<div class="callout callout-info">' +
                    '   <p>Hasil kategori kecerdasan anda adalah: '+data_history.nama+'</p>' +
                    '   <p>Keterangan tambahan: '+data_history.keterangan+'</p>' +
                    '   <p>Total poin kecerdasan anda: '+data_history.total_point+'</p>' +
                    '</div>';
                
                html_output_string = html_output_string.trim();

                $("#data_container_location").empty().append(html_output_string);
            },
            error: function(data){
                console.log(data);
            }
        });
    });
</script>