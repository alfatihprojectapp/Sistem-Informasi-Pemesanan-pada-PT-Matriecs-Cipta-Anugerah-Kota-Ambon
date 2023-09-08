<div>

    <?php include 'function/time.php'; ?>

    @if (session()->has('message'))
        <div>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Check out pesanan berhasil',
                    allowOutsideClick: false
                }).then(() => {
                    window.location.href = '/perumahan/pesanan/history';
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
                        <h5> <i class="bi bi-cart-check"></i> Check out pesanan</h5>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3 row">
                            <label for="nomor_telepon" class="col-sm-4 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror"
                                    value="{{ auth()->user()->no_hp }}" id="nomor_telepon" name="nomor_telepon"
                                    wire:model.defer="nomor_telepon">
                                @error('nomor_telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @if (session()->has('error'))
                                    <small class="text-danger">nomor telepon tidak sesuai</small>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control  @error('alamat') is-invalid @enderror" id="alamat" rows="3" name="alamat"
                                    wire:model.defer="alamat"></textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <style>
                            .detail {
                                background: #de00e6;
                                color: #e0e0e0
                            }

                            .detail:hover {
                                background: #4d0040;
                                transition: 0.3s;
                                color: #ffffff
                            }
                        </style>
                        <button type="button"id="closeModal" class="btn detail px-4"
                            data-bs-dismiss="modal">Batal</button>
                        <button class="btn detail px-4" style="width: 100px;">
                            <span wire:loading.remove wire:target="store">Simpan</span>
                            <span wire:loading wire:target="store" class="spinner-border spinner-border-sm text-light"
                                role="status" aria-hidden="true" style="width: 12px; height: 12px;"></span>
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
