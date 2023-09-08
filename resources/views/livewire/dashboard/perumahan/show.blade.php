<div>

    <div wire:ignore.self class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><i class="bi bi-card-text"></i> Data detail</h5>
                    <button id="closeModal" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="carouselExampleIndicators" class="carousel slide mb-3" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/' . $image_1) }}" class="d-block w-100" style="height: 350px;">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('storage/' . $image_2) }}" class="d-block w-100" style="height: 350px;">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('storage/' . $image_3) }}" class="d-block w-100" style="height: 350px;">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <ol class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="me-auto">
                                <div class="fw-bold">Nama Perumahan</div>
                            </div>
                            <span class="text-secondary ms-4">{{ $nama_perumahan }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="me-auto">
                                <div class="fw-bold">Slug</div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <span class="text-secondary ms-4">{{ $slug }}</span>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="me-auto">
                                <div class="fw-bold">Harga per Unit</div>
                            </div>
                            <span class="text-secondary ms-4">{{ 'Rp. ' . number_format($harga, 2, ',', ',') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="me-auto">
                                <div class="fw-bold">Uang Muka</div>
                            </div>
                            <span
                                class="text-secondary ms-4">{{ 'Rp. ' . number_format($uang_muka, 2, ',', ',') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="me-auto">
                                <div class="fw-bold">Bayar Angsuran</div>
                            </div>
                            <span
                                class="text-secondary ms-4">{{ 'Rp. ' . number_format($angsuran, 2, ',', ',') . '/Bln.' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="me-auto">
                                <div class="fw-bold">Type</div>
                            </div>
                            <span class="text-secondary ms-4">{{ $type }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="me-auto">
                                <div class="fw-bold">Jumlah Rumah</div>
                            </div>
                            <span class="text-secondary ms-4">{{ $jumlah }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="me-auto">
                                <div class="fw-bold">Stok Rumah</div>
                            </div>
                            <span class="text-secondary ms-4">{{ $stok }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="me-auto">
                                <div class="fw-bold">Fasilitas Rumah</div>
                            </div>
                            <span class="text-secondary ms-4">{!! $fasilitas !!}</span>
                        </li>
                    </ol>
                    <div class="row">
                        <div class="col-md-12">
                            {!! $informasi_lain !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    {{-- <button type="button" wire:click="showModalFalse" class="btn bg-secondary px-4"
                            data-bs-dismiss="modal">Batal</button>
                        <button class="btn bg-primary px-4">Update</button> --}}
                </div>
            </div>
        </div>
    </div>


    @if ($closeModal)
        <script>
            $(document).ready(function() {
                $('#showModal').modal('hide');
            })
        </script>
    @endif


</div>
