<div>

    @if (session()->has('message'))
        <div>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Data berhasil diubah',
                    allowOutsideClick: false
                })
            </script>
        </div>
    @endif

    <form wire:submit.prevent="update">
        @csrf
        <div wire:ignore.self class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5><i class="bi bi-pencil"></i> Ubah data</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" wire:model.defer="logo_old">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('nama_instansi') is-invalid @enderror"
                                            placeholder="Nama Instansi" name="nama_instansi" id="nama_instansi"
                                            wire:model.defer="nama_instansi">
                                        <label for="nama_instansi">Nama Instansi</label>
                                        @error('nama_instansi')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('latitude') is-invalid @enderror"
                                            placeholder="Koordinat Latitude" name="latitude" id="latitude"
                                            wire:model.defer="latitude">
                                        <label for="latitude">Koordinat Latitude</label>
                                        @error('latitude')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('longitude') is-invalid @enderror"
                                            placeholder="Koordinat Longitude" name="longitude" id="longitude"
                                            wire:model.defer="longitude">
                                        <label for="longitude">Koordinat Longitude</label>
                                        @error('longitude')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('kode_pos') is-invalid @enderror"
                                            placeholder="Kode Pos" name="kode_pos" id="kode_pos" wire:model.defer="kode_pos">
                                        <label for="kode_pos">Kode Pos</label>
                                        @error('kode_pos')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            placeholder="Alamat" name="alamat" id="alamat" wire:model.defer="alamat">
                                        <label for="alamat">Alamat</label>
                                        @error('alamat')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Email" name="email" id="email" wire:model.defer="email">
                                        <label for="email">Email</label>
                                        @error('email')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('telepon') is-invalid @enderror"
                                            placeholder="Nomor Telepon" name="telepon" id="telepon"
                                            wire:model.defer="telepon">
                                        <label for="telepon">Nomor Telepon</label>
                                        @error('telepon')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="file" class="hidden d-inline mb-1" id="logo"
                                            wire:model.defer="logo" style="" onchange="imgPreview()"
                                            style="height: 58px;">
                                        <label for="logo"><span type="submit"
                                                class="badge bg-secondary py-2 px-3">Image Logo</span></label>
                                        <span wire:loading wire:target="logo" wire:key="logo">
                                            <i class="spinner-border" role="status"
                                                style="margin-bottom: -7px; margin-left: 5px;"></i>
                                        </span>
                                        @error('logo')
                                            <small class="text-danger d-block">{{ $message }}</small>
                                        @enderror
                                        <div wire:ignore>
                                            <img class="img-preview img-fluid d-block mt-2" style="width: 100px;"
                                                height="100">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div wire:ignore>
                                            <textarea wire:model.defer="deskripsi" class="form-control" name="deskripsi" id="deskripsi"></textarea>
                                        </div>
                                        @error('deskripsi')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" id="closeModal" class="btn bg-light border-primary px-4"
                            data-bs-dismiss="modal">Batal</button>
                        <button class="btn bg-light border-primary px-4" style="width: 100px;">
                            <span wire:target="update" wire:loading.remove>Simpan</span>
                            <span wire:loading wire:target="update"
                                class="spinner-border spinner-border-sm text-primary" role="status"
                                aria-hidden="true" style="width: 13px; height: 13px;"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>
        $(document).ready(function() {
            $('#deskripsi').summernote({
                placeholder: 'Background Instansi',
                tabsize: 2,
                height: 187,
                toolbar: [
                    ['groupName', ['list of button']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['picture', 'math']]
                ],
                callbacks: {
                    onChange: function(contents) {
                        @this.set('deskripsi', contents);
                    }
                },
            });
        });
    </script>

    @if ($closeModal)
        <script>
            $(document).ready(function() {
                $('#editModal').modal('hide');
            })
        </script>
    @endif


</div>
