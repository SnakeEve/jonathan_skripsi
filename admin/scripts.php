<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
    const protocol = window.location.protocol;
    const environment = window.location.host;
    const url_local_root = protocol + "//" + environment ;
    const project_name = "jonathan_skripsi";
    const url_local_project_root = url_local_root + "/" + project_name + "/admin";

    $(document).ready(function() {
        $("#user_status").on( "click", function() {
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


</script>