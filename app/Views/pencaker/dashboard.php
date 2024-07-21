<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<meta name="csrf-token" content="<?= csrf_hash() ?>">

<style>
    a.disabled:hover {
        cursor: not-allowed !important;
    }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Pencari Kerja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Status Anda</h3>
                </div>
                <div class="card-body">
                    <h2 class="text-bold"><?php echo $id_pencaker['keterangan_status']; ?></h2>

                    <?php if ($id_pencaker['keterangan_status'] == 'Verifikasi') : ?>
                        <div class="alert alert-info" role="alert">
                            Dokumen Anda sudah dikirim untuk diverifikasi oleh Admin Disnaker.
                        </div>
                    <?php else : ?>
                        <p>
                            <?php if ($isDataComplete && $isDocumentComplete) : ?>
                        <div class="alert alert-success" role="alert">
                            Data Anda sudah lengkap. Silakan ajukan verifikasi data di bawah ini.
                        </div>
                    <?php else : ?>
                        <div class="alert alert-warning" role="alert">
                            Data Anda belum lengkap. Silakan cek Formulir AK/1 pada menu Profil Pencaker dan mengunggah dokumen pada menu Dokumen Pencaker.
                        </div>
                    <?php endif; ?>
                    </p>
                    <form id="verificationForm">
                        <input type="hidden" class="form-control" name="id_pencaker" id="id_pencaker" readonly value="<?= $id_pencaker['id']; ?>">
                        <input type="hidden" id="mintaVerifikasi" name="mintaverifikasi" value="Verifikasi">
                        <button id="verifyLink" class="btn btn-primary <?= $isDataComplete && $isDocumentComplete ? '' : 'btn btn-secondary disabled' ?>">Minta Verifikasi Data</button>
                    </form>
                <?php endif; ?>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Timeline Aktivitas Anda</h3>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="time-label">
                            <span class="bg-red">10 Feb. 2014</span>
                        </div>
                        <div>
                            <i class="fas fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-primary btn-sm">Read more</a>
                                    <a class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <i class="fas fa-user bg-green"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                            </div>
                        </div>
                        <div>
                            <i class="fas fa-comments bg-yellow"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                <div class="timeline-body">
                                    Take me to your leader!
                                    Switzerland is small and neutral!
                                    We are more like Germany, ambitious and misunderstood!
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-warning btn-sm">View comment</a>
                                </div>
                            </div>
                        </div>
                        <div class="time-label">
                            <span class="bg-green">3 Jan. 2014</span>
                        </div>
                        <div>
                            <i class="fa fa-camera bg-purple"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                <div class="timeline-body">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                </div>
                            </div>
                        </div>
                        <div>
                            <i class="fas fa-video bg-maroon"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>
                                <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                                <div class="timeline-body">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="timeline-footer">
                                    <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
                    the plugin.
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        $('#verifyLink').on('click', function(event) {
            event.preventDefault(); // Mencegah tombol dari aksi default

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Pastikan semua data yang Anda input sudah benar dan dokumen-dokumen yang diunggah dapat dibaca dengan baik (tidak kabur).',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Saya Yakin!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, submit form menggunakan AJAX
                    var id_pencaker = $('#id_pencaker').val();
                    var formData = {
                        id_pencaker: id_pencaker,
                        keterangan_status: $('#mintaVerifikasi').val(),
                    };

                    $.ajax({
                        url: '<?= site_url("pencaker/minta_verifikasi") ?>',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Semua informasi tentang Anda telah dikirim untuk selanjutnya diverifikasi.',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Eror!',
                                text: 'Gagal melakukan verifikasi data!',
                            });
                        }
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>