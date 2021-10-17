<div class="modal fade show" id="create-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna Baru (<span
                        class="text-danger text-sm">Password SIAJAR32</span>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="create-user-form">

                    <div class="form-group">
                        <div id="username-field">
                            <label for="username">Username</label>
                            <input type="text"
                                class="form-control @error('username')
                          is-invalid
                          @enderror"
                                id="username" name="username" placeholder="Masukkan nama pengguna"
                                value="{{ old('username') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div id="email-field">
                            <label for="email">Email</label>
                            <input type="text"
                                class="form-control @error('email')
                          is-invalid
                          @enderror"
                                id="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div id="role-field">
                            <label for="role">Level Pengguna</label>
                            <select class="form-control" id="role" name="role">
                                <option selected value="3">Siswa</option>
                                <option value="2">Guru</option>
                                <option value="1">Admin</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-check"></i>
                        Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
