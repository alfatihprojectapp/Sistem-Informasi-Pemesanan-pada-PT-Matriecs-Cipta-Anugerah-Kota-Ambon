<div>

    <title>{{ ucwords($profil->nama_instansi) }} - {{ $title }}</title>

    <section id="team" class="team section-bg">
        <div wire:ignore.self class="container" data-aos="fade-up">

            <div class="row justify-content-center" style="margin-top: -40px;height: 75vh;">
                <div class="col-md-4">
                    <div class="d-flex justify-content-center">
                        <img src="/assets/img/logo.png" class="img-fluid" style="width: 250px;">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card-body">
                        @if (session()->has('message'))
                            <script>
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Login gagal',
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            </script>
                        @endif
                        <h5 class="text-center mb-3"><i class="bi bi-box-arrow-in-right"></i> Login</h5>
                        <form wire:submit.prevent="auth" class="mt-2">
                            @csrf
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" wire:model.defer="nomor_telepon"
                                        class="form-control @error('nomor_telepon') is-invalid @enderror"
                                        placeholder="Username atau Nomor Telepon" value="{{ old('nomor_telepon') }}"
                                        name="nomor_telepon" id="nomor_telepon" autofocus>
                                    <label for="nomor_telepon">Username atau Nomor Telepon</label>
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
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        name="password" placeholder="password" value="">
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
                                <label for="lihatPassword" style="font-weight: normal;margin-top:0px;margin-left: 5px;">
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
                                class="w-100 btn detail border-1 mt-5 btn-get-started"
                                name="login">
                                <span wire:click="auth" wire:loading.remove>
                                    <i class="bi bi-box-arrow-in-right"></i> Login
                                </span>
                                <span wire:loading wire:target="auth"
                                    class="spinner-border spinner-border-sm text-light" role="status"
                                    aria-hidden="true"></span>
                            </button>

                            <div class="icheck-primary d-flex align-items-center" style="margin-top:10px;">
                                <input type="checkbox" id="remember_me" wire:model.defer="remember_me">
                                <label for="remember_me" style="font-weight: normal;margin-top:0px;margin-left: 5px;">
                                    <small class="text-dark">Ingat Saya !</small>
                                </label>
                            </div>

                        </form>
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
