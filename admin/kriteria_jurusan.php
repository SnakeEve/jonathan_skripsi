<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Jurusan Kecerdasan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="index.php?page=kriteria">Kecerdasan</a></li>
                        <li class="breadcrumb-item active"><a href="#">Jurusan</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <table id="main_datatable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>MENU <button class="btn btn-sm btn-primary" id="btnNew"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                        <th>ID</th>
                                        <th>Nama Jurusan</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="ModalData" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formData">
                <div class="modal-header">
                    <h4 class="modal-title">Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row" id="hide_id">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>id</label>
                                    <input type="text" class="form-control" id="data_id" placeholder="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <select class="form-control" id="data_jurusan" required>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var kecerdasan_id = "<?php echo  isset($_GET['kecerdasan_id'])? $_GET['kecerdasan_id']:"";?>";
    var datatable_main;
    var submit_type;

    $(document).ready(function () {
        datatable_main = $('#main_datatable').DataTable({
            language: {
                processing: "<span class='spinner-border spinner-border-sm'></span>"
            },
            contentType: "application/json; charset=utf-8",
            destroy: true,
            cache: true,
            deferRender: true,
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            ajax: {
                "url": "../api/admin/kecerdasan.php?apiname=detailReferensiJurusan&id_kecerdasan="+kecerdasan_id,
                "type": "GET",
                "headers": {
                    'Content-Type': 'application/json'
                },
                "dataSrc": function ( value ) {
                    console.log(value)
                    if (value.data === null || (value.data.list === null || value.data.list <= 0)) {
                        return [];
                    }
                    return value.data.list;
                }
            },
            columns: [
                {
                    "data": "id",
                    "width": "90px",
                    "orderable": false,
                    "render": function (data, type, row) {
                        var button_string = "";
                        button_string += '<div class="btn-group flex-wrap">';
                        button_string += '<button type="button" class="btn btn-danger btn-sm btnModalDataDelete" ><i class="fa fa-trash" aria-hidden="true"></i></button> ';
                        button_string += '</div>';
                        return button_string;
                    }
                },
                {"data": "id", "visible": false},
                {"data": "nama"}
            ],
            columnDefs: [
                {
                    targets: ['_all'],
                    // searchable: true,
                    // sortable: true,
                    // visible: true,
                    defaultContent: ""
                }
            ],
            order: [1, 'asc'],
            initComplete: function( settings, json ) {
                $(settings.nTable).closest(".col-sm-12").css("overflow", "auto");
            }
        });

        $('#btnNew').on('click', function () {
            submit_type = 'insert';
            $("#hide_id").hide();
            $('#formData')[0].reset();
            fill_jurusan();
            $('#ModalData').modal('show');
        });

        $('#main_datatable tbody').on('click', '.btnModalDataDelete', function () {
            if (confirm("Are you sure?")) {
                var tr = $(this).closest('tr');
                var row = datatable_main.row(tr);

                var formDataObject = {
                    id_referensi_jurusan: row.data().id
                };

                $.ajax({
                    url: '../api/admin/kecerdasan.php?apiname=deleteReferensiJurusan',
                    type: 'POST',
                    data: JSON.stringify(formDataObject),
                    contentType: "application/json",
                    dataType: "json",
                    success: function (output) {
                        if (output.responseCode === '0000') {
                            datatable_main.ajax.reload();
                        } else {
                            alert(output.message);
                        }
                    },
                    error: function (output) {
                        alert(output.message);
                    }
                });
            }
            
        });

        $('#formData').on('submit', function (e) {
            e.preventDefault();

            var formDataObject = {
                id_jurusan: $("#data_jurusan").val(),
                id_kecerdasan: kecerdasan_id
            };

            $.ajax({
                url: '../api/admin/kecerdasan.php?apiname=addReferensiJurusan',
                type: 'POST',
                data: JSON.stringify(formDataObject),
                contentType: "application/json",
                dataType: "json",
                success: function (output) {
                    if (output.responseCode === '0000') {
                        $('#ModalData').modal('hide');
                        datatable_main.ajax.reload();
                    } else {
                        alert(output.message);
                    }
                },
                error: function (output) {
                    alert(output.message);
                }
            });

        });

    });

    function fill_jurusan(){
        $('#data_jurusan').empty();
        $.ajax({
            url: '../api/admin/jurusan.php?apiname=get_all_list',
            type: 'GET',
            contentType: "application/json",
            dataType: "json",
            success: function (output) {
                if (output.responseCode === '0000' && output.data != null && output.data.list != null) {
                    var data = output.data.list;
                    var html = '';
                    html += '<option>PILIH JURUSAN</option>';
                    for (var i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].id + '">' + data[i].nama_jurusan + '</option>';
                    }
                    $('#data_jurusan').empty().html(html);
                }
            }
        });
    }
</script>