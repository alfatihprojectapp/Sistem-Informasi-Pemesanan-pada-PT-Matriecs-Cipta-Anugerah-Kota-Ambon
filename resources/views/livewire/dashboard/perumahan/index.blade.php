<div>

    <title>{{ $title }} </title>

    @if (session()->has('import_success'))
        <div>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Import data berhasil',
                    allowOutsideClick: false
                })
            </script>
        </div>
    @endif

    <div class="content-wrapper">
        <!-- title page -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <h5 class="m-0">{!! $icon !!} {{ $title_page }}
                            <button wire:click="create" class="badge bg-light border-1 border-primary py-2 mb-1"
                                style="font-size: 10pt;font-weight: normal;width: 150px;">
                                <span wire:target="create" wire:loading.remove><i class="bi bi-plus-lg"></i> Tambah
                                    Data</span>
                                <span wire:loading wire:target="create"
                                    class="spinner-border spinner-border-sm text-primary" role="status"
                                    aria-hidden="true" style="width: 13px;height: 13px;"></span>
                            </button>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- continer -->
        <section class="content">
            <div class="container-fluid">

                @if ($showLivewireCreate)
                    @livewire('dashboard.perumahan.create')
                    <script>
                        $(document).ready(function() {
                            $('#createModal').modal('show');
                        });
                    </script>
                @endif
                @if ($showLivewireUpdate)
                    @livewire('dashboard.perumahan.update', ['perumahan' => $getPerumahan])
                    <script>
                        $(document).ready(function() {
                            $('#editModal').modal('show');
                        });
                    </script>
                @endif
                @if ($showLivewireDelete)
                    @livewire('dashboard.perumahan.delete', ['perumahan' => $getPerumahan])
                    <script>
                        $(document).ready(function() {
                            $('#deleteModal').modal('show');
                        });
                    </script>
                @endif
                @if ($showLivewireShow)
                    @livewire('dashboard.perumahan.show', ['perumahan' => $getPerumahan])
                    <script>
                        $(document).ready(function() {
                            $('#showModal').modal('show');
                        });
                    </script>
                @endif
                <script>
                    $(document).on('click', '#closeModal', function() {
                        Livewire.emit('closeLivewire');
                    });
                </script>

                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-select sm w-auto" wire:model="paginate">
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <input wire:model="search" type="text" placeholder="Cari" class="form-control">
                                    <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                                </div>
                            </div>
                        </div>
                        @if ($perumahan->count())
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle;text-align: center;">#</th>
                                            <th style="vertical-align: middle;">Nama Perumahan</th>
                                            <th style="vertical-align: middle;text-align: center;">Jumlah Rumah</th>
                                            <th style="vertical-align: middle;text-align: center;">Tersedia</th>
                                            <th style="vertical-align: middle;text-align: right;">Harga/Unit</th>
                                            <th style="width: 150px;text-align: center; vertical-align: middle;">Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($perumahan as $data)
                                            <tr>
                                                <td style="vertical-align: middle;text-align: center;">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td style="vertical-align: middle;">{{ $data->nama_perumahan }}</td>
                                                <td style="vertical-align: middle;text-align: center;">
                                                    {{ $data->jumlah }}</td>
                                                <td style="vertical-align: middle;text-align: center;">
                                                    {{ $data->stok }}</td>
                                                <td style="vertical-align: middle;text-align: right;">
                                                    {{ 'Rp. ' . number_format($data->harga, 2, ',', ',') }}
                                                </td>
                                                <td style="vertical-align: middle;text-align: center;">
                                                    <button style="width: 40px;"
                                                        class="badge bg-primary mb-1 border-0 py-2"
                                                        wire:click="show({{ $data->id_perumahan }})"
                                                        ata-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Lihat">
                                                        <span wire:target="show({{ $data->id_perumahan }})"
                                                            wire:loading.remove>
                                                            <i class="bi bi-eye"></i>
                                                        </span>
                                                        <span wire:loading wire:target="show({{ $data->id_perumahan }})"
                                                            class="spinner-border spinner-border-sm text-light"
                                                            role="status" aria-hidden="true"
                                                            style="width: 10px; height: 10px;">
                                                        </span>
                                                    </button>

                                                    <button style="width: 40px;"
                                                        class="badge bg-success mb-1 border-0 py-2"
                                                        wire:click="edit({{ $data->id_perumahan }})"
                                                        ata-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Ubah">
                                                        <span wire:target="edit({{ $data->id_perumahan }})"
                                                            wire:loading.remove>
                                                            <i class="bi bi-pen"></i>
                                                        </span>
                                                        <span wire:loading
                                                            wire:target="edit({{ $data->id_perumahan }})"
                                                            class="spinner-border spinner-border-sm text-light"
                                                            role="status" aria-hidden="true"
                                                            style="width: 10px; height: 10px;">
                                                        </span>
                                                    </button>

                                                    <button style="width: 40px;"
                                                        class="badge bg-danger mb-1 border-0 py-2"
                                                        wire:click="delete({{ $data->id_perumahan }})"
                                                        ata-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Hapus">
                                                        <span wire:target="delete({{ $data->id_perumahan }})"
                                                            wire:loading.remove>
                                                            <i class="bi bi-trash"></i>
                                                        </span>
                                                        <span wire:loading
                                                            wire:target="delete({{ $data->id_perumahan }})"
                                                            class="spinner-border spinner-border-sm text-light"
                                                            role="status" aria-hidden="true"
                                                            style="width: 10px; height: 10px;">
                                                        </span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">{{ $perumahan->links() }}</div>
                        @else
                            <hr>
                            <p class="text-center text-secondary mt-5">Data tidak ditemukan !</p>
                        @endif
                    </div>
                </div>

            </div>
        </section>

    </div>

    <script>
        function imgPreview1() {
            const image = document.querySelector('#image_1');
            const imgPreview = document.querySelector('.img-preview-1');

            const oFReader = new FileReader();

            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }

        }

        function imgPreview2() {
            const image = document.querySelector('#image_2');
            const imgPreview = document.querySelector('.img-preview-2');

            const oFReader = new FileReader();

            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }

        }

        function imgPreview3() {
            const image = document.querySelector('#image_3');
            const imgPreview = document.querySelector('.img-preview-3');

            const oFReader = new FileReader();

            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }

        }
    </script>

    <script>
        function imgPreviewUpdate1() {
            const image = document.querySelector('#image_update_1');
            const imgPreview = document.querySelector('.img-preview-update-1');

            const oFReader = new FileReader();

            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }

        }

        function imgPreviewUpdate2() {
            const image = document.querySelector('#image_update_2');
            const imgPreview = document.querySelector('.img-preview-update-2');

            const oFReader = new FileReader();

            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }

        }

        function imgPreviewUpdate3() {
            const image = document.querySelector('#image_update_3');
            const imgPreview = document.querySelector('.img-preview-update-3');

            const oFReader = new FileReader();

            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }

        }
    </script>

</div>
