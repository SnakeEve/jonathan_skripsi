<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="#">Users</a></li>
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
                                        <th>Nama</th>
                                        <th>Telp</th>
                                        <th>Agama</th>
                                        <th>Tgl Lahir</th>
                                        <th>Tempat Lahir</th>
                                        <th>User Type</th>
                                        <th>Email</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status</th>
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
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="data_nama" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Telp</label>
                                    <input type="text" class="form-control" id="data_telp" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Agama</label>
                                    <select id="data_agama" class="form-control" required>
                                        <option selected>Pilih Agama</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Tgl Lahir</label>
                                    <input type="date" class="form-control" id="data_tgl_lahir" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control" id="data_tempat_lahir" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select id="data_user_type" class="form-control" required>
                                        <option value="A">Admin</option>
                                        <option value="U">Mahasiswa</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="data_email" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="data_password" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select id="data_jenis_kelamin" class="form-control" required>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
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
                "url": "../api/user.php?apiname=list",
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
                        button_string += '<button type="button" class="btn btn-info btn-sm btnModalDataUpdate" ><i class="fas fa-edit"></i></button> ';
                        button_string += '<button type="button" class="btn btn-danger btn-sm btnModalDataDelete" ><i class="fa fa-trash" aria-hidden="true"></i></button> ';
                        button_string += '</div>';
                        return button_string;
                    }
                },
                {"data": "id", "visible":false},
                {"data": "nama"},
                {"data": "no_hp"},
                {"data": "agama"},
                {"data": "tanggal_lahir"},
                {"data": "tempat_lahir"},
                {
                    "data": "user_type",
                    "render": function (data, type, row) {
                        if(data == 'A')
                            return 'Admin';
                        else if(data == 'M')
                            return 'Mahasiswa';
                        else 
                            return "";
                    }
                },
                {"data": "email"},
                {
                    "data": "jenis_kelamin",
                    "render": function (data, type, row) {
                        if(data == 'L')
                            return 'Laki-laki';
                        else if(data == 'P')
                            return 'Perempuan';
                        else 
                            return "";
                    }
                },
                {
                    "data": "is_active",
                    "render": function (data, type, row) {
                        if(data == 'T')
                            return '<span class="badge badge-success">Active</span>';
                        else
                            return '<span class="badge badge-danger">Inactive</span>';
                    }
                }
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
            $('#ModalData').modal('show');
        });

        $('#main_datatable tbody').on('click', '.btnModalDataDelete', function () {
            if (confirm("Are you sure?")) {
                var tr = $(this).closest('tr');
                var row = datatable_main.row(tr);

                var formDataObject = {
                    "id": row.data().id
                };

                $.ajax({
                    url: '../api/user.php?apiname=delete',
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
            $("#data_nama").val(row.data().nama);
            $("#data_telp").val(row.data().no_hp);
            $("#data_agama").val(row.data().agama);
            $("#data_tgl_lahir").val(row.data().tanggal_lahir);
            $("#data_tempat_lahir").val(row.data().tempat_lahir);
            // $("#data_user_type").val(row.data().user_type);
            $("#data_email").val(row.data().email);
            $("#data_jenis_kelamin").val(row.data().jenis_kelamin);

            $('#ModalData').modal('show');
        });

        $('#formData').on('submit', function (e) {
            e.preventDefault();

            if(submit_type == 'update'){
                var formDataObject = {
                    id: $("#data_id").val(),
                    nama: $("#data_nama").val(),
                    no_hp: $("#data_telp").val(),
                    agama: $("#data_agama").val(),
                    tanggal_lahir: $("#data_tgl_lahir").val(),
                    tempat_lahir: $("#data_tempat_lahir").val(),
                    // user_type: $("#data_user_type").val(),
                    email: $("#data_email").val(),
                    jenis_kelamin: $("#data_jenis_kelamin").val(),
                    password: $("#data_password").val()
                };

                $.ajax({
                    url: '../api/user.php?apiname=update',
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
            }
            else{
                var formDataObject = {
                    nama: $("#data_nama").val(),
                    no_hp: $("#data_telp").val(),
                    agama: $("#data_agama").val(),
                    tanggal_lahir: $("#data_tgl_lahir").val(),
                    tempat_lahir: $("#data_tempat_lahir").val(),
                    // user_type: $("#data_user_type").val(),
                    email: $("#data_email").val(),
                    jenis_kelamin: $("#data_jenis_kelamin").val(),
                    password: $("#data_password").val()
                };

                $.ajax({
                    url: '../api/user.php?apiname=register',
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
            }

        });

    });
</script>