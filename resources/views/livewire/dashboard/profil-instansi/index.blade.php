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
                            <button wire:click="edit" class="badge bg-light border-1 border-primary py-2 mb-1"
                                style="font-size: 10pt;font-weight: normal;width: 150px;">
                                <span wire:target="edit" wire:loading.remove><i class="bi bi-pen"></i> Ubah
                                    Data</span>
                                <span wire:loading wire:target="edit"
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

                @if ($showLivewireUpdate)
                    @livewire('dashboard.profil-instansi.update', ['profil' => $getProfil])
                    <script>
                        $(document).ready(function(){
                            $('#editModal').modal('show');
                        })
                    </script>
                @endif
                <script>
                    $(document).on('click', '#closeModal', function(){
                        Livewire.emit('closeLivewire');
                    });
                </script>

                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <ol class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="me-auto">
                                            <div class="fw-bold">NAMA INSTANSI</div>
                                            <span class="text-secondary">{{ $profil->nama_instansi }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="me-auto">
                                            <div class="fw-bold">ALAMAT INSTANSI</div>
                                            <span class="text-secondary">{{ $profil->alamat }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="me-auto">
                                            <div class="fw-bold">NOMOR TELEPON</div>
                                            <span class="text-secondary">{{ $profil->telepon }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="me-auto">
                                            <div class="fw-bold">EMAIL</div>
                                            <span class="text-secondary">{{ $profil->email }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="me-auto">
                                            <div class="fw-bold">KODE POS</div>
                                            <span class="text-secondary">{{ $profil->kode_pos }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="me-auto">
                                            <div class="fw-bold">KOORDINAT INSTANSI</div>
                                            <span class="text-secondary">{{ $profil->latitude.', '.$profil->longitude }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="me-auto">
                                            <div class="fw-bold">LOGO INSTANSI</div>
                                            <img src="{{ asset('storage/'.$profil->logo) }}" class="img-fluid" style="width: 120px;">
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="me-auto">
                                            <div class="fw-bold">BACKGROUND INSTANSI</div>
                                            <span class="text-secondary">{{ $profil->deskripsi }}</span>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>

    <script>
        function imgPreview() {
            const image = document.querySelector('#logo');
            const imgPreview = document.querySelector('.img-preview');

            const oFReader = new FileReader();

            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }

        }
    </script>

</div>
