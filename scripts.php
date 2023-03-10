<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
    const protocol = window.location.protocol;
    const environment = window.location.host;
    const url_local_root = protocol + "//" + environment ;
    const project_name = "jonathan_skripsi";
    const url_local_project_root = url_local_root + "/" + project_name;

    $(document).ready(function() {
        $("#user_status").on( "click", function() {
            $.ajax({
                url: url_local_project_root + "/api/user.php?apiname=detail&id="+<?php echo $id; ?>,
                type: "GET",
                data: {
                    action: "list"
                },
                success: function(result) {
                    let response = JSON.parse(result);
                    let responseCode = response.responseCode;
                    let message = response.message;

                    if (responseCode == "0000") {
                        console.log(response.data)
                        $("#email").val(response.data.email);
                        $("#nama").val(response.data.nama);
                        $("#nomor_telepon").val(response.data.no_hp);
                        $("#agama").val(response.data.agama);
                        $("#tanggal_lahir").val(response.data.tanggal_lahir);
                        $("#tempat_lahir").val(response.data.tempat_lahir);
                        $("#jenis_kelamin").val(response.data.jenis_kelamin);
                    } else {
                        console.log(message);
                    }
                }
            });

            $("#user_modal").show();
            $('.nav-tabs a[href="#biodata"]').tab('show');
        });

    });

    function closeUserModal() {
        $("#user_modal").hide();
    }
    
    function truncate_elipsis(input) {
        let length = 300;
        if (input.length > length) {
            return input.substring(0, length) + '...';
        }
        return input;
    }

    function javascript_logout() {
        if (confirm("Are you sure?")) {
            window.location.replace("logout.php");
        }
    }

</script>