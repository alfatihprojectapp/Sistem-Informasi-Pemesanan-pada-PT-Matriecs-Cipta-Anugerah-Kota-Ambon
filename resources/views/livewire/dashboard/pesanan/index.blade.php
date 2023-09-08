<div>

    <title>{{ $title }} </title>

    @php
        $message = explode('/', session('message'));
    @endphp
    @if (session()->has('message'))
        <div>
            <script>
                Swal.fire({
                    // position: 'top-end',
                    icon: '{{ $message[0] }}',
                    text: '{{ $message[1] }}',
                    allowOutsideClick: false,
                    // showConfirmButton: false,
                    // timer: 2000
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
                            <span class="badge bg-primary">{{ $pesanan_masuk }}</span>
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
                @endif
                @if ($showLivewireUpdate)
                    @livewire('dashboard.perumahan.update')
                @endif
                @if ($showLivewireDelete)
                    @livewire('dashboard.perumahan.delete')
                @endif
                @if ($showLivewireShow)
                    @livewire('dashboard.perumahan.show')
                @endif

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
                        @if ($pesanan->count())
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle;text-align: center;">#</th>
                                            <th style="vertical-align: middle;">Nama Pemesan</th>
                                            <th style="vertical-align: middle;">Tanggal Pesanan</th>
                                            <th style="vertical-align: middle;text-align: center;">Pesanan</th>
                                            <th style="vertical-align: middle;text-align: center;">Telepon</th>
                                            <th style="width: 150px;vertical-align: middle;">Alamat</th>
                                            <th style="width: 150px;vertical-align: middle;text-align: center;">
                                                Negosiasi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesanan as $data)
                                            <tr>
                                                <td style="vertical-align: middle;text-align: center;">
                                                    {{ $loop->iteration }}</td>
                                                <td style="vertical-align: middle;">{{ $data->user->nama }}</td>
                                                <td style="vertical-align: middle;">{{ $data->created_at }}
                                                    <small class="text-secondary d-block"
                                                        style="font-style: italic;">{{ $data->created_at->diffForHumans() }}</small>
                                                </td>
                                                <td style="vertical-align: middle;text-align: center;">
                                                    <button class="badge bg-primary border-0 py-2"
                                                        data-bs-toggle="modal" data-bs-target="#modalPesanan"
                                                        id="detailPesanan" data-id="{{ $data->id_pesanan }}">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </td>
                                                <td style="vertical-align: middle;text-align: center;">
                                                    {{ $data->user->no_hp }}</td>
                                                <td style="vertical-align: middle;">{{ $data->user->alamat }}</td>

                                                <td style="vertical-align: middle;text-align: center;">

                                                    <button class="badge bg-danger py-2 border-0" title="Batal"
                                                        wire:click="pesanan_batal({{ $data->id_pesanan }})">
                                                        <span wire:loading.remove
                                                            wire:target="pesanan_batal({{ $data->id_pesanan }})"><i
                                                                class="bi bi-x-lg"></i></span>
                                                        <span wire:loading
                                                            wire:target="pesanan_batal({{ $data->id_pesanan }})"
                                                            class="spinner-border spinner-border-sm text-light"
                                                            role="status" aria-hidden="true"
                                                            style="width: 10px; height: 10px;">
                                                        </span>
                                                    </button>

                                                    <button class="badge bg-success py-2 border-0" title="Disetujui"
                                                        wire:click="pesanan_disetujui({{ $data->id_pesanan }})">
                                                        <span wire:loading.remove
                                                            wire:target="pesanan_disetujui({{ $data->id_pesanan }})">
                                                            <i class="bi bi-hand-thumbs-up-fill"></i>
                                                        </span>
                                                        <span wire:loading
                                                            wire:target="pesanan_disetujui({{ $data->id_pesanan }})"
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
                            <div class="d-flex justify-content-end">{{ $pesanan->links() }}</div>
                        @else
                            <hr>
                            <p class="text-center text-secondary mt-5">Data tidak ditemukan !</p>
                        @endif
                    </div>
                </div>

            </div>
        </section>

    </div>

    <!-- Modal detail pesanan -->
    <div class="modal fade" id="modalPesanan" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="modalPesananLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPesananLabel"><i class="bi bi-card-list"></i> Detail Pesanan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="table-responsive">
                        <table class="table table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col" style="vertical-align: middle;text-align: center;width: 30px;">#
                                    </th>
                                    <th scope="col" style="vertical-align: middle;text-align: left;">Nama Perumahan
                                    </th>
                                    <th scope="col" style="vertical-align: middle;text-align: center;">Jumlah</th>
                                    <th scope="col" style="vertical-align: middle;text-align: center;">Harga</th>
                                    <th scope="col" style="vertical-align: middle;text-align: center;">Total
                                        Harga</th>
                                </tr>
                            </thead>
                            <tbody id="dataPesanan">

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '#detailPesanan', function() {

            const id = $(this).data('id');

            $.ajax({
                url: '/get-pesanan-detail?id=' + id,
                type: 'GET',
                // dataType: 'json',
                success: function(data) {
                    $('#modalPesanan #dataPesanan').html(data);
                }
            });

        });
    </script>

</div>
