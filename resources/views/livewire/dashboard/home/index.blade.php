<div>
    <?php include 'function/time.php'; ?>

    <title>SD Muhammadiyah Ambon | Dashboard </title>

    @if (session()->has('message'))
        <script>
            let timerInterval
            Swal.fire({
                title: 'Selamat Datang !',
                html: 'Silahkan tunggu beberapa detik',
                timer: 1000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then(() => {
                // location.reload();
            })
        </script>
    @endif

    <div class="content-wrapper">
        <!-- title page -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5 class="m-0">{!! $icon !!} {{ $title_page }} </h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- continer -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="bi bi-envelope-check"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Pesanan Masuk</span>
                                <span class="info-box-number">
                                    {{$pesan_masuk}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="bi bi-envelope-slash"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Pesanan Batal</span>
                                <span class="info-box-number">
                                    {{$pesan_batal}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="bi bi-people"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Jumlah Pelanggan</span>
                                <span class="info-box-number">
                                    {{$jum_pelanggan}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 pt-0">
                            <div class="card-header">
                                Waktu & Kalender {{ $tahun }}
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="bi bi-x-lg text-secondary"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-8">
                                        <style>
                                            .datepicker,
                                            .table-condensed {
                                                width: 100%;
                                                height: 400px;
                                                line-height: 50px;
                                                font-size: 12pt;
                                            }
                                        </style>
                                        <div id="datepicker" class="datepicker mb-5" size="30">
                                            <span class="add-on">
                                                <i class="icon-th"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <?php include 'function/jam-analog.php'; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>

</div>

<script>
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>
