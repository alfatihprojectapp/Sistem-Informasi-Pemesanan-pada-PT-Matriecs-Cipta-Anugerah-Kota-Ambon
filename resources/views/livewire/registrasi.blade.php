<div>

    <title>{{ ucwords($profil->nama_instansi) }} - {{ $title }}</title>

    @php
        $message = explode('/', session('message'));
    @endphp
    @if (session()->has('message'))
        <div>
            <script>
                Swal.fire({
                    position: 'top-end',
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

    @php
        $message_2 = explode('/', session('message_2'));
    @endphp
    @if (session()->has('message_2'))
        <div>
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: '{{ $message_2[0] }}',
                    title: '{{ $message_2[1] }}',
                    text: '{{ $message_2[2] }}',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = '/login';
                })
            </script>
        </div>
    @endif


    <section id="team" class="team section-bg">
        <div wire:ignore.self class="container" data-aos="fade-up">

            <div class="row justify-content-center" style="margin-top: -40px;height: 100%;">
                <div class="col-md-5">
                    <div class="card-body">
                        <h5 class="text-center mb-3"><i class="bi bi-person-check"></i> Registrasi Akun</h5>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade @if ($proses_1) show active @endif"
                                id="proses-1" role="tabpanel" aria-labelledby="proses-1-tab">
                                <form wire:submit.prevent="register" class="mt-2">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="text" wire:model.defer="nama"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                placeholder="nama" value="{{ old('nama') }}" name="nama"
                                                id="nama" autofocus>
                                            <label for="nama">Nama Lengkap</label>
                                            @error('nama')
                                                <div class="invalid-feedback d-flex justify-content-star">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="text" wire:model.defer="nomor_telepon"
                                                class="form-control @error('nomor_telepon') is-invalid @enderror"
                                                placeholder="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                                name="nomor_telepon" id="nomor_telepon" autofocus>
                                            <label for="nomor_telepon">Nomor Telepon</label>
                                            @error('nomor_telepon')
                                                <div class="invalid-feedback d-flex justify-content-star">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input wire:ignore.self type="password" wire:model.defer="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" placeholder="password" value="">
                                            <label for="password">Password</label>
                                            @error('password')
                                                <div class="invalid-feedback d-flex justify-content-star">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="icheck-primary d-flex align-items-center" style="margin-top:-10px;">
                                        <input type="checkbox" id="lihatPassword">
                                        <label for="lihatPassword"
                                            style="font-weight: normal;margin-top:0px;margin-left: 5px;">
                                            <small class="text-dark">Lihat Password</small>
                                        </label>
                                    </div>

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

                                    <button type="submit"
                                        class="w-100 btn border-1 detail mt-3 btn-get-started"
                                        name="login">
                                        <span wire:click="register" wire:loading.remove>Simpan</span>
                                        <span id="loading" wire:loading wire:target="register"
                                            class="spinner-border spinner-border-sm text-light" role="status"
                                            aria-hidden="true">
                                        </span>
                                    </button>

                                </form>
                            </div>
                            <div class="tab-pane fade @if ($proses_2) show active @endif"
                                id="proses-2" role="tabpanel" aria-labelledby="proses-2-tab">
                                <form wire:submit.prevent="verification" class="mt-2">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="text" wire:model.defer="kode_otp"
                                                class="form-control @error('kode_otp') is-invalid @enderror"
                                                placeholder="kode_otp" value="{{ old('kode_otp') }}" name="kode_otp"
                                                id="kode_otp" autofocus>
                                            <label for="kode_otp">Kode OTP</label>
                                            @error('kode_otp')
                                                <div class="invalid-feedback d-flex justify-content-star">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            @if (session()->has('error_kode'))
                                                <div class="invalid-feedback d-flex justify-content-star">
                                                    <small class="text-danger">kode otp invalid</small>
                                                </div>
                                            @endif
                                        </div>
                                        <small class="text-secondary">Silahkan Tunggu ! <br>Kode OTP Akan Dikirim
                                            Melalui SMS ke Nomor Anda.
                                        </small>
                                    </div>

                                    <button type="submit"
                                        class="w-100 btn border-1 detail mt-3 btn-get-started"
                                        name="login">
                                        <span wire:click="verification" wire:loading.remove>Verifikasi</span>
                                        <span id="loading" wire:loading wire:target="verification"
                                            class="spinner-border spinner-border-sm text-light" role="status"
                                            aria-hidden="true">
                                        </span>
                                    </button>

                                </form>
                            </div>
                        </div>
                        <ul class="nav nav-tabs mt-5 d-flex justify-content-center" id="myTab" role="tablist"
                            style="font-size: 10pt;">
                            <li class="nav-item" role="presentation">
                                <button wire:click="proses_1"
                                    class="nav-link @if ($proses_1) active @endif" id="proses-1-tab"
                                    data-bs-toggle="tab" data-bs-target="#proses-1" type="button" role="tab"
                                    aria-controls="proses-1" aria-selected="true">Registrasi</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button wire:click="proses_2"
                                    class="nav-link @if ($proses_2) active @endif" id="proses-2-tab"
                                    data-bs-toggle="tab" data-bs-target="#proses-2" type="button" role="tab"
                                    aria-controls="proses-2" aria-selected="false">Verifikasi</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <script>
        $(document).on('click', '#lihatPassword', function() {

            const password = document.querySelector('#password');

            if (password.type == 'password') {
                password.type = 'text'
            } else {
                password.type = 'password';
            }

        })
    </script>

</div>
