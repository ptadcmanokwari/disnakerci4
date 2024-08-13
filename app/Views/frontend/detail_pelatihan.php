<?= $this->extend('frontend/template') ?>
<?= $this->section('content') ?>
<style>
    .btn-info {
        background-color: #116db6;
        border: 0;
    }
</style>
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
        </div>
    </div>
</section>

<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8 entries">
                <article class="entry entry-single">
                    <div class="entry-img">
                        <img src="<?= base_url('uploads/pelatihan/' . $pelatihan['gambar']) ?>" alt="<?= $pelatihan['judul'] ?>" class="w-100">
                    </div>
                    <h2 class="entry-title">
                        <?= $pelatihan['judul'] ?>
                    </h2>
                    <div class="entry-meta">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#"><?= $pelatihan['namalengkap'] ?></a></li>
                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="<?= $pelatihan['tanggal'] ?>"><?= date('M d, Y', strtotime($pelatihan['tanggal'])) ?></time></a></li>
                            <li class="d-flex align-items-center"><i class="bi bi-tag"></i> <a href="#"><?= $pelatihan['pelatihan'] ?></a></li>
                        </ul>
                    </div>
                    <hr>
                    <div class="entry-content mb-4">
                        <?= $pelatihan['isi'] ?>
                    </div>
                </article>
            </div>

            <div class="col-lg-4">
                <div class="sidebar">
                    <hr>
                    <h3 class="sidebar-title">Join Pelatihan</h3>
                    <p class="text-secondary">Anda dapat mengikuti pelatihan ini dengan cara klik tombol di bawah ini.</p>
                    <a href="<?= $pelatihan['link'] ?>" class="btn btn-info text-light text-small mt-3" target="_blank"><i class="bi bi-paperclip mx-2"></i>Bergabung Sekarang</a>

                    <hr>
                    <h3 class="sidebar-title mt-3">Pelatihan Lainnya</h3>
                    <div class="sidebar-item recent-posts">
                        <?php if (empty($recentPosts)) : ?>
                            <p class="text-muted">Belum ada data untuk ditampilkan di halaman ini.</p>
                        <?php else : ?>
                            <?php foreach ($recentPosts as $post) : ?>
                                <div class="post-item clearfix">
                                    <img src="<?= base_url('uploads/pelatihan/' . $post['gambar']); ?>" alt="<?= $post['judul']; ?>">
                                    <h4><a href="<?= $post['slug']; ?>"><?= substr(strip_tags($post['judul']), 0, 50) ?> ...</a></h4>
                                    <time datetime="<?= $post['tanggal']; ?>"><?= date('M d, Y', strtotime($post['tanggal'])); ?></time>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?= $this->endSection() ?>