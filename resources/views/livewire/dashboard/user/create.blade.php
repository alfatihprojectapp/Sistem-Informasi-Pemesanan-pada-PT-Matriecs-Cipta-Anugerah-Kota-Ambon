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
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5> <i class="bi bi-plus-lg"></i> Tambah data</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('nama')
                                                    is-invalid
                                                @enderror"
                                            placeholder="Nama Admin" value="{{ old('nama') }}" name="nama"
                                            id="nama" wire:model.defer="nama">
                                        <label for="nama">Nama Admin</label>
                                        @error('nama')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('username')
                                                    is-invalid
                                                @enderror"
                                            placeholder="Username" value="{{ old('username') }}" name="username"
                                            id="username" wire:model.defer="username">
                                        <label for="username">Username</label>
                                        @error('username')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('password')
                                                    is-invalid
                                                @enderror"
                                            placeholder="Password" value="{{ old('password') }}" name="password"
                                            id="password" wire:model.defer="password">
                                        <label for="password">Password</label>
                                        @error('password')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
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
                            <span wire:loading.remove wire:target="store">Simpan</span> 
                            <span wire:loading wire:target="store" class="spinner-border spinner-border-sm text-primary"
                                role="status" aria-hidden="true" style="width: 13px; height: 13px;"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if ($closeModal)
        <script>
            $(document).ready(function() {
                $('#createModal').modal('hide');
            })
        </script>
    @endif


</div>
