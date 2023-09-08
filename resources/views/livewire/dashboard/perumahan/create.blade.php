<div>

    @if (session()->has('message'))
        <div>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Data berhasil ditambahkan',
                    allowOutsideClick: false
                })
            </script>
        </div>
    @endif

    <form wire:submit.prevent="store">
        @csrf
        <div wire:ignore.self class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5> <i class="bi bi-plus-lg"></i> Tambah data</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('nama_perumahan') is-invalid @enderror"
                                            placeholder="Nama Perumahan" name="nama_perumahan" id="nama_perumahan"
                                            wire:model.defer="nama_perumahan">
                                        <label for="nama_perumahan">Nama Perumahan</label>
                                        @error('nama_perumahan')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('jumlah') is-invalid @enderror"
                                            placeholder="Jumlah Rumah" name="jumlah" id="jumlah"
                                            wire:model.defer="jumlah">
                                        <label for="jumlah">Jumlah Rumah</label>
                                        @error('jumlah')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                            placeholder="Harga Rumah" name="harga" id="harga"
                                            wire:model.defer="harga">
                                        <label for="harga">Harga Rumah</label>
                                        @error('harga')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('uang_muka') is-invalid @enderror"
                                            placeholder="Uang Muka" name="uang_muka" id="uang_muka"
                                            wire:model.defer="uang_muka">
                                        <label for="uang_muka">Uang Muka</label>
                                        @error('uang_muka')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('angsuran') is-invalid @enderror"
                                            placeholder="Uang Muka" name="angsuran" id="angsuran"
                                            wire:model.defer="angsuran">
                                        <label for="angsuran">Jumlah Angsuran</label>
                                        @error('angsuran')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('type') is-invalid @enderror"
                                            placeholder="Type" name="type" id="type" wire:model.defer="type">
                                        <label for="type">Type</label>
                                        @error('type')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <div wire:ignore>
                                            <textarea wire:model.defer="fasilitas" class="form-control" name="fasilitas" id="fasilitas"></textarea>
                                        </div>
                                        @error('fasilitas')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="file" class="hidden d-inline mb-1" id="image_1"
                                            wire:model.defer="image_1" style="" onchange="imgPreview1()"
                                            style="height: 58px;">
                                        <label for="image_1"><span type="submit"
                                                class="badge bg-secondary py-2 px-3">Image 1</span></label>
                                        <span wire:loading wire:target="image_1" wire:key="image_1">
                                            <i class="spinner-border" role="status"
                                                style="margin-bottom: -7px; margin-left: 5px;"></i>
                                        </span>
                                        @error('image_1')
                                            <small class="text-danger d-block">{{ $message }}</small>
                                        @enderror
                                        <div wire:ignore>
                                            <img class="img-preview-1 img-fluid d-block mt-2" style="width: 100px;"
                                                height="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="file" class="hidden d-inline mb-1" id="image_2"
                                            wire:model.defer="image_2" style="" onchange="imgPreview2()"
                                            style="height: 58px;">
                                        <label for="image_2"><span type="submit"
                                                class="badge bg-secondary py-2 px-3">Image 2</span></label>
                                        <span wire:loading wire:target="image_2" wire:key="image_2">
                                            <i class="spinner-border" role="status"
                                                style="margin-bottom: -7px; margin-left: 5px;"></i>
                                        </span>
                                        @error('image_2')
                                            <small class="text-danger d-block">{{ $message }}</small>
                                        @enderror
                                        <div wire:ignore>
                                            <img class="img-preview-2 img-fluid d-block mt-2" style="width: 100px;"
                                                height="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="file" class="hidden d-inline mb-1" id="image_3"
                                            wire:model.defer="image_3" style="" onchange="imgPreview3()"
                                            style="height: 58px;">
                                        <label for="image_3"><span type="submit"
                                                class="badge bg-secondary py-2 px-3">Image 3</span></label>
                                        <span wire:loading wire:target="image_3" wire:key="image_3">
                                            <i class="spinner-border" role="status"
                                                style="margin-bottom: -7px; margin-left: 5px;"></i>
                                        </span>
                                        @error('image_3')
                                            <small class="text-danger d-block">{{ $message }}</small>
                                        @enderror
                                        <div wire:ignore>
                                            <img class="img-preview-3 img-fluid d-block mt-2" style="width: 100px;"
                                                height="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div wire:ignore>
                                            <textarea wire:model.defer="informasi_lain" class="form-control" name="informasi_lain" id="informasi_lain"></textarea>
                                        </div>
                                        @error('informasi_lain')
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
                        <button class="btn bg-light px-4 border-primary" style="width: 100px;">
                            <span wire:target="store" wire:loading.remove>Simpan</span>
                            <span wire:loading wire:target="store"
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
            $('#fasilitas').summernote({
                placeholder: 'Fasilitas',
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
                        @this.set('fasilitas', contents);
                    }
                },
            });
            $('#informasi_lain').summernote({
                placeholder: 'Informasi Lain',
                tabsize: 2,
                height: 400,
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
                        @this.set('informasi_lain', contents);
                    }
                },
            });
        })
    </script>

    @if ($closeModal)
        <script>
            $(document).ready(function() {
                $('#createModal').modal('hide');
            });
        </script>
    @endif

</div>
