<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Perguruan Tinggi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Perguruan Tinggi</a></li>
                        <!-- <li class="breadcrumb-item active">Simple Tables</li> -->
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
                                        <th>MENU <button class="btn btn-sm btn-primary" id="btnNew"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </th>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Description</th>
                                        <th>Pendaftaran</th>
                                        <th>Foto</th>
                                        <th>Website</th>
                                        <th>Telp</th>
                                        <th>Akreditasi</th>
                                        <th>Email</th>
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
                                    <label>Description</label>
                                    <textarea class="form-control summernote_here" id="data_description" rows="5" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Pendaftaran</label>
                                    <textarea class="form-control summernote_here" id="data_pendaftaran" rows="5" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" id="data_foto" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" class="form-control" id="data_website" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>No Telp</label>
                                    <input type="text" class="form-control" id="data_telp" placeholder="" required>
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
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="data_email" placeholder="" required>
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
                "url": "../api/admin/perguruan_tinggi.php?apiname=list_all",
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
                        button_string += '<a href="index.php?page=fasilitas_perguruan_tinggi&univ_id='+data+'" class="btn btn-warning btn-sm" >FASILITAS</a> ';
                        button_string += '<a href="index.php?page=ukm_perguruan_tinggi&univ_id='+data+'" class="btn btn-info btn-sm" >UKM</a> ';
                        button_string += '<a href="index.php?page=program_studi_perguruan_tinggi&univ_id='+data+'" class="btn btn-success btn-sm" ><i class="fa fa-book"></i></a> ';
                        button_string += '<button type="button" class="btn btn-primary btn-sm btnModalDataUpdate" ><i class="fas fa-edit"></i></button> ';
                        button_string += '<button type="button" class="btn btn-danger btn-sm btnModalDataDelete" ><i class="fa fa-trash" aria-hidden="true"></i></button> ';
                        button_string += '</div>';
                        return button_string;
                    }
                },
                {"data": "id"},
                {"data": "nama"},
                {"data": "description"},
                {"data": "pendaftaran"},
                {
                    "data": "foto",
                    "render": function (data, type, row) {
                        if(data != null){
                            return '<img src="../' + data + '" class="img-thumbnail" alt="No Image" style="width:200px;">';
                        }
                    }
                },
                {"data": "website"},
                {"data": "no_telp"},
                {"data": "akreditasi"},
                {"data": "email"},
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
                    url: '../api/admin/perguruan_tinggi.php?apiname=delete',
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

        $('#main_datatable tbody').on('click', '.btnModalDataUpdate', function () {
            submit_type = 'update';
            $("#hide_id").show();
            $('#formData')[0].reset();
            var tr = $(this).closest('tr');
            var row = datatable_main.row(tr);

            console.log(row.data())

            $("#data_id").val(row.data().id);
            $("#data_nama").val(row.data().nama);
            // $("#data_description").val(row.data().description);
            
            $('#data_description').summernote('code', row.data().description);
            $('#data_pendaftaran').summernote('code', row.data().pendaftaran);

            $("#data_website").val(row.data().website);
            $("#data_telp").val(row.data().no_telp);
            $("#data_akreditasi").val(row.data().akreditasi);
            $("#data_email").val(row.data().email);

            $('#ModalData').modal('show');
        });

        $('#formData').on('submit', function (e) {
            e.preventDefault();

            if(submit_type == 'update'){
                let formData = new FormData();
                var jsonString = {
                    id: $("#data_id").val(),
                    nama: $("#data_nama").val(),
                    description: $("#data_description").val(),
                    pendaftaran: $("#data_pendaftaran").val(),
                    website: $("#data_website").val(),
                    no_telp: $("#data_telp").val(),
                    akreditasi: $("#data_akreditasi").val(),
                    email: $("#data_email").val()
                }
                formData.append('json', JSON.stringify(jsonString));
                if( $("#data_foto")[0].files.length > 0){
                    formData.append('photo', $("#data_foto")[0].files[0]);
                }

                $.ajax({
                    url: '../api/admin/perguruan_tinggi.php?apiname=update',
                    type: 'POST',
                    contentType: false,
	                processData: false,
                    data: formData,
	                beforeSend: function(){},
                    success: function (output) {
                        console.log(output);
                        output = JSON.parse(output);
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
                let formData = new FormData();
                var jsonString = {
                    id: $("#data_id").val(),
                    nama: $("#data_nama").val(),
                    description: $("#data_description").val(),
                    pendaftaran: $("#data_pendaftaran").val(),
                    website: $("#data_website").val(),
                    no_telp: $("#data_telp").val(),
                    akreditasi: $("#data_akreditasi").val(),
                    email: $("#data_email").val()
                }
                formData.append('json', JSON.stringify(jsonString));
                formData.append('photo', $("#data_foto")[0].files[0]);

                $.ajax({
                    url: '../api/admin/perguruan_tinggi.php?apiname=insert',
                    type: 'POST',
                    contentType: false,
	                processData: false,
                    data: formData,
	                beforeSend: function(){},
                    success: function (output) {
                        output = JSON.parse(output);
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