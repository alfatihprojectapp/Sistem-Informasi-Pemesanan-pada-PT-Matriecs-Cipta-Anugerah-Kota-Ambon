<div>
    <title>{{ ucwords($profil->nama_instansi) }} - {{ $title }}</title>

    @php
        $message = explode('/', session('message'));
    @endphp
    @if (session()->has('message'))
        <div>
            <script>
                Swal.fire({
                    // position: 'top-end',
                    icon: '{{ $message[0] }}',
                    title: '{{ $message[1] }}',
                    text: '{{ $message[2] }}',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 2000
                })
            </script>
        </div>
    @endif

    <section id="team" class="team section-bg">
        <div wire:ignore.self class="container" data-aos="fade-up">
            <div class="section-title">
                <div class="d-flex align-items-center justify-content-center" style="margin-top: -40px;">
                    <div class="d-inline-block"
                        style="width: 15px;height: 15px; border-top: 3px solid rgb(87, 2, 61) ;border-left: 4px solid;">
                    </div>
                    <h4 style="margin-top: 35px;margin-left: px;">
                        <i class="bi bi-cart"></i> KERANJANG PESANAN
                    </h4>
                    <div class="d-inline-block"
                        style="width: 15px;height: 15px; border-bottom: 3px solid rgb(87, 2, 61) ;border-right: 4px solid;margin-top: 45px;margin-left: px;">
                    </div>
                </div>
            </div>
            @if ($pesanan != null)
                @if ($pesanan->total_harga != 0)
                    <div class="table-responsive">
                        <table class="table table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col" style="vertical-align: middle;text-align: center;width: 30px;">#
                                    </th>
                                    <th scope="col" style="vertical-align: middle;text-align:;">Nama Perumahan
                                    </th>
                                    <th scope="col" style="vertical-align: middle;text-align: center;">Jumlah Pesanan
                                    </th>
                                    <th scope="col" style="vertical-align: middle;text-align: center;">Harga</th>
                                    <th scope="col" style="vertical-align: middle;text-align: center;">Total Harga
                                    </th>
                                    <th scope="col" style="vertical-align: middle;text-align: center;">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftar_pesanan as $data)
                                    <tr>
                                        <th scope="row" style="vertical-align: middle;text-align: center;">
                                            {{ $loop->iteration }}</th>
                                        <td style="vertical-align: middle;text-align:;">
                                            {{ $data->perumahan->nama_perumahan }}
                                        </td>
                                        <td style="vertical-align: middle;text-align: center;">
                                            {{ $data->jumlah_pesanan }}
                                        </td>
                                        <td style="vertical-align: middle;text-align: right;">Rp.
                                            {{ number_format($data->perumahan->harga, 2) }}</td>
                                        <td style="vertical-align: middle;text-align: right;">Rp.
                                            {{ number_format($data->total_harga, 2) }}</td>
                                        <td style="vertical-align: middle;text-align: right;">
                                            <button type="submit" class="badge bg-danger p-3 border-0"
                                                wire:click="delete({{ $data->id_detail }})">
                                                <span wire:target="delete({{ $data->id_detail }})" wire:loading.remove>
                                                    <i class="bi bi-trash"></i>
                                                </span>
                                                <span wire:loading wire:target="delete({{ $data->id_detail }})"
                                                    class="spinner-border spinner-border-sm text-light" role="status"
                                                    aria-hidden="true" style="width: 13px; height: 13px;">
                                                </span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="4" style="vertical-align: middle;text-align: right;">Total
                                        Pembayaran
                                    </th>
                                    <td style="vertical-align: middle;text-align: right;">Rp.
                                        {{ number_format($total_pembayaran + 10000, 2, ',', ',') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="vertical-align: middle;text-align: right;">
                                        <style>
                                            .detail {
                                                background: #de00e6;
                                            }

                                            .detail:hover {
                                                background: #4d0040;
                                                transition: 0.3s;
                                            }
                                        </style>
                                        <button type="button" class="badge detail border-0 py-2" wire:click="check_out"
                                            style="width: 120px;">
                                            <span wire:target="check_out" wire:loading.remove>
                                                <i class="bi bi-cart-check"></i> Check out
                                            </span>
                                            <span wire:loading wire:target="check_out"
                                                class="spinner-border spinner-border-sm text-light" role="status"
                                                aria-hidden="true" style="width: 12px; height: 12px;">
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center fs-4 text-danger">Keranjang kosong !</p>
                @endif
            @else
                <p class="text-center fs-4 text-danger">Keranjang kosong !</p>
            @endif

        </div>

        @if ($showModalCheckOut)
            @livewire('check-out', ['telepon' => $telepon, 'alamat' => $alamat])
            <script>
                $(document).ready(function() {
                    $('#createModal').modal('show');
                });
            </script>
        @endif
        <script>
            $(document).on('click', '#closeModal', function() {
                Livewire.emit('closeLivewire');
            });
        </script>

    </section>

</div>
