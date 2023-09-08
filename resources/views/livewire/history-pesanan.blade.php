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

    <section id="team" class="team section-bg" data-aos="fade-up">
        <div class="section-title">
            <div class="d-flex align-items-center justify-content-center" style="margin-top: -40px;">
                <div class="d-inline-block"
                    style="width: 15px;height: 15px; border-top: 3px solid rgb(87, 2, 61) ;border-left: 4px solid;">
                </div>
                <h4 style="margin-top: 35px;margin-left: px;">
                    <i class="bi bi-folder-check"></i> HISTORY PESANAN
                </h4>
                <div class="d-inline-block"
                    style="width: 15px;height: 15px; border-bottom: 3px solid rgb(87, 2, 61) ;border-right: 4px solid;margin-top: 45px;margin-left: px;">
                </div>
            </div>
        </div>

        @if ($pesanan->count() > 0)

            <div class="table-responsive">
                <style>
                    table thead tr th {
                        text-align: center;
                        vertical-align: middle;
                    }

                    table tbody tr td {
                        text-align: center;
                        vertical-align: middle;
                    }
                </style>
                <table class="table table-striped text-center" style="width: 100%;font-size: 10pt;" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Pesanan</th>
                            <th>Pesanan</th>
                            <th>Total Pembayaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>
                                    <style>
                                        .detail {
                                            background: #de00e6;
                                        }

                                        .detail:hover {
                                            background: #4d0040;
                                            transition: 0.3s;
                                        }
                                    </style>
                                    <button class="badge detail border-0 py-2 px-4" data-bs-toggle="modal"
                                        data-bs-target="#modalPesanan" id="id" data-id="{{ $data->id_pesanan }}">
                                        Lihat
                                    </button>

                                </td>
                                <td>Rp. {{ number_format($data->total_harga, 2, ',', ',') }}</td>
                                <td>
                                    @if ($data->status == 1)
                                        <span class="text-warning">Dalam proses</span>
                                    @elseif($data->status == 2)
                                        <span class="text-danger">Pesanan batal</span>
                                    @else
                                        <span class="text-success">Pesanan disetujui</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card mt-2">
                <div class="card-body" style="font-size: 10pt;">
                    <div class="card-text">
                        Terima kasih telah melakukan pemesanan. Permintaan anda akan segera di proses.
                    </div>
                    <div class="card-text">
                        Untuk informasi selanjutnya anda akan dihubungi oleh pihak dari <b>PT. MATRIECS CIPTA ANUGERAH.</b>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center fs-4 text-danger">History belanja kosong !</p>
        @endif
    </section>

    <!-- Modal detail pesanan -->
    <div class="modal fade" id="modalPesanan" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="modalPesananLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
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
        $(document).on('click', '#id', function() {

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
