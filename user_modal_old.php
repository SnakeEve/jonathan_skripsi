<div id="user_modal" class="modal" tabindex="-1" role="dialog" style="overflow-y:scroll;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Detail</h5>
                <button type="button" class="close" onclick="closeUserModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" href="#biodata" role="tab" data-toggle="tab">Biodata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#informasi_akun" role="tab" data-toggle="tab">Informasi Akun</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade" id="biodata">
                        <form id="biodata_form">
                            <div class="form-group">
                                <label for="nama_depan">Nama Depan</label>
                                <input type="text" class="form-control" id="nama_depan" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="nomor_telepon">Nomor Telepon</label>
                                <input type="text" class="form-control" id="nomor_telepon" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select id="jenis_kelamin" class="form-control" required>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="calendar" class="form-control" id="tanggal_lahir" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <select id="agama" class="form-control">
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
                            <div class="float-right">
                                <button type="button" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" onclick="closeUserModal()">Close</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="informasi_akun">
                        <form id="informasi_akun_form">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="example@aqses.com">
                            </div>
                            <div class="form-group">
                                <label for="password_1">Password</label>
                                <input type="password" class="form-control" id="password_1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="password">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" onclick="closeUserModal()">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer"></div> -->
        </div>
    </div>
</div>