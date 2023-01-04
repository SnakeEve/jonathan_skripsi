<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Program Studi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php?page=universitas">Perguruan Tinggi</a></li>
                        <li class="breadcrumb-item active"><a href="#">Program Studi</a></li>
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
                                        <th>Fakultas ID</th>
                                        <th>Fakultas</th>
                                        <th>Jurusan ID</th>
                                        <th>Jurusan</th>
                                        <th>Akreditasi</th>
                                        <th>Kelas</th>
                                        <th>Biaya Persemester (Rp)</th>
                                        <th>Biaya Masuk (Rp)</th>
                                        <!--<th>Status</th>-->
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
                        <span aria-hidden="true">×</span>
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
                                    <label>Program Studi</label>
                                    <select class="form-control" id="data_program_studi" required>
                                        <option></option>
                                    </select>
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
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Akreditasi</label>
                                    <select class="form-control" id="data_akreditasi" required>
                                        <option>PILIH AKREDITASI</option>
                                        <option value="A" >A</option>
                                        <option value="B" >B</option>
                                        <option value="C" >C</option>
                                        <option value="D" >D</option>
                                        <option value="E" >E</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select class="form-control" id="data_kelas" required>
                                        <option>PILIH KELAS</option>
                                        <option value="Reguler" >Reguler</option>
                                        <option value="Karyawan" >Karyawan</option>
                                        <option value="Reguler & Karyawan" >Reguler & Karyawan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Biaya Persemester (Rp)</label>
                                    <input type="text" class="form-control" id="data_biaya_per_semester" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Biaya Masuk (Rp)</label>
                                    <input type="text" class="form-control" id="data_biaya_masuk" placeholder="" required>
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
    var univ_id = "<?php echo  isset($_GET['univ_id'])? $_GET['univ_id']:"";?>";
    var datatable_main;
    var submit_type;

    function fill_program_studi(selected_data){
        $('#data_program_studi').empty();
        $('#data_jurusan').empty();
        $.ajax({
            url: '../api/admin/program_studi.php?apiname=list',
            type: 'GET',
            contentType: "application/json",
            dataType: "json",
            success: function (output) {
                if (output.responseCode === '0000' && output.data != null && output.data.list != null) {
                    var data = output.data.list;
                    var html = '';
                    html += '<option>PILIH PROGRAM STUDI</option>';
                    for (var i = 0; i < data.length; i++) {
                        if(selected_data != null && selected_data == data[i].id){
                            html += '<option value="' + data[i].id + '" selected>' + data[i].nama + '</option>';
                        }
                        else{
                            html += '<option value="' + data[i].id + '">' + data[i].nama + '</option>';
                        }
                    }
                    $('#data_program_studi').empty().html(html);

                    if(selected_data != null){
                        fill_jurusan($('#data_program_studi').val());
                    }
                }
            }
        });
    }

    function fill_jurusan(selected_data){
        var program_studi_id = $('#data_program_studi').val();
        $('#data_jurusan').empty();
        $.ajax({
            url: '../api/admin/jurusan.php?apiname=get_all_list_by_program_studi&program_studi_id='+program_studi_id,
            type: 'GET',
            contentType: "application/json",
            dataType: "json",
            success: function (output) {
                if (output.responseCode === '0000' && output.data != null && output.data.list != null) {
                    var data = output.data.list;
                    var html = '';
                    html += '<option>PILIH JURUSAN</option>';
                    for (var i = 0; i < data.length; i++) {
                        if(selected_data != null && selected_data == data[i].id){
                            html += '<option value="' + data[i].id + '" selected>' + data[i].nama_jurusan + '</option>';
                        }
                        else{
                            html += '<option value="' + data[i].id + '">' + data[i].nama_jurusan + '</option>';
                        }
                    }
                    $('#data_jurusan').empty().html(html);
                }
            }
        });
    }

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
                "url": "../api/admin/perguruan_tinggi.php?apiname=detailProgramStudi&id_perguruan_tinggi="+univ_id,
                "type": "GET",
                "headers": {
                    'Content-Type': 'application/json'
                },
                "dataSrc": function ( value ) {
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
                        //button_string += '<button type="button" class="btn btn-info btn-sm btnModalDataUpdate" ><i class="fas fa-edit"></i></button> ';
                        button_string += '<button type="button" class="btn btn-danger btn-sm btnModalDataDelete" ><i class="fa fa-trash" aria-hidden="true"></i></button> ';
                        button_string += '</div>';
                        return button_string;
                    }
                },
                {"data": "id"},
                {"data": "id_program_studi", "visible":false},
                {"data": "nama_program_studi"},
                {"data": "id_jurusan", "visible":false},
                {"data": "nama_jurusan"},
                {"data": "akreditasi"},
                {"data": "kelas"},
                {"data": "biaya_masuk"},
                {"data": "biaya_per_semester"}//,
                // {
                //     "data": "is_active",
                //     "render": function (data, type, row) {
                //         if(data == 'T')
                //             return '<span class="badge badge-success">Active</span>';
                //         else
                //             return '<span class="badge badge-danger">Inactive</span>';
                //     }
                // }
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
            fill_program_studi();
            $("#hide_id").hide();
            $('#formData')[0].reset();
            $('#ModalData').modal('show');
        });

        fill_program_studi();

        $('#data_program_studi').on('change', function () {
            fill_jurusan($('#data_program_studi').val());
        });

        $('#main_datatable tbody').on('click', '.btnModalDataDelete', function () {
            if (confirm("Are you sure?")) {
                var tr = $(this).closest('tr');
                var row = datatable_main.row(tr);

                var formDataObject = {
                    "id_jurusan_kuliah": row.data().id
                };

                $.ajax({
                    url: '../api/admin/perguruan_tinggi.php?apiname=deleteProgramStudi',
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

        $('#main_datatable tbody').on('click', '.btnModalDataUpdate', function () {
            submit_type = 'update';
            $("#hide_id").show();
            $('#formData')[0].reset();
            var tr = $(this).closest('tr');
            var row = datatable_main.row(tr);

            $("#data_id").val(row.data().id);
            fill_program_studi(row.data().id_program_studi);
            $("#data_biaya_masuk").val(row.data().biaya_masuk);
            $("#data_biaya_per_semester").val(row.data().biaya_per_semester);
            $("#data_akreditasi").val(row.data().akreditasi);
            $("#data_kelas").val(row.data().kelas);

            $('#ModalData').modal('show');
        });

        $('#formData').on('submit', function (e) {
            e.preventDefault();
            var formDataObject = {
                id_jurusan: $("#data_jurusan").val(),
                id_perguruan_tinggi: univ_id,
                biaya_masuk: $("#data_biaya_masuk").val(),
                biaya_per_semester: $("#data_biaya_per_semester").val(),
                akreditasi: $("#data_akreditasi").val(),
                kelas: $("#data_kelas").val()
            };

            $.ajax({
                url: '../api/admin/perguruan_tinggi.php?apiname=addProgramStudi',
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
</script>