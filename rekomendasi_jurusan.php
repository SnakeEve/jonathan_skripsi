<main role="main">
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h3>Cari jurusan kuliah yang cocok untuk kamu</h3>
                    <h5 id="rekomendasi_question">Silahkan Jawab Pertanyaan umum di bawah ini untuk menentukan jurusan yang paling cocok untuk anda!</h5>
                </div>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Soal</th>
                            <th>Jawaban</th>
                        </tr>
                    </thead>
                    <tbody id="print_soal_container"></tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button id="btnSubmit" class="btn btn-primary form-control btn-block" type="button">SUBMIT</button>
            </div>
        </div>

    </div>
</div>
<script>
    var user_id = <?php echo $id; ?>;
    $(document).ready(function(){
        $.ajax({
            url: url_local_project_root + "/api/admin/soal.php?apiname=list_frontend",
            type: "GET",
            dataType: "json",
            success: function(result){
                let html_output_string = "";

                $.each(result.data.list, function( index, value ) {
                    console.log(value);
                    //value.id
                    html_output_string += '' +
                    '<tr>' +
                    '   <td>' + parseInt(index+1) + '</td>' +
                    '   <td>' + value.nama + '</td>' +
                    '   <td>' +
                    '       <div class="form-check">' +
                    '           <label class="form-check-label">' +
                    '               <input type="radio" class="form-check-input" name="jawaban_soal_'+value.id+'" data-id_soal="'+value.id+'" value="T">YA' +
                    '           </label>' +
                    '       </div>' +
                    '       <div class="form-check">' +
                    '           <label class="form-check-label">' +
                    '               <input type="radio" class="form-check-input" name="jawaban_soal_'+value.id+'" data-id_soal="'+value.id+'" value="F">TIDAK' +
                    '           </label>' +
                    '       </div>' +
                    '   </td>' +
                    '</tr>' +
                    '';
                });
                
                html_output_string = html_output_string.trim();

                $("#print_soal_container").empty().append(html_output_string);
            },
            error: function(data){
                console.log(data);
            }
        });

        $("#btnSubmit").on("click", function(){
            let jawaban = [];
            $.each($("input[name^='jawaban_soal_']"), function( index, value ) {
                if($(value).is(":checked")){
                    jawaban.push({
                        id_soal: $(value).data("id_soal"),
                        jawaban: $(value).val()
                    });
                }
            });

            var object_jawaban = JSON.stringify({
                id_user: user_id,
                tes_kecerdasan: jawaban
            });

            $.ajax({
                url: url_local_project_root + "/api/mahasiswa/tes_kecerdasan.php?apiname=save",
                type: "POST",
                dataType: "json",
                data: object_jawaban,
                success: function(result){
                    if(result.responseCode === "0000"){
                        alert("Berhasil menyimpan jawaban");
                        window.location.href = url_local_project_root + "/index.php?page=history_rekomendasi";
                    }
                    else{
                        alert("Gagal menyimpan jawaban");
                    }
                }
            });
        });

    });
</script>