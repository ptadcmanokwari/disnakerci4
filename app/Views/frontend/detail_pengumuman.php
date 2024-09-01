<?= $this->extend('frontend/template') ?>
<?= $this->section('content') ?>

<style>
    a.btn.btn-info.text-light {
        background-color: #116db6 !important;
        border: 0 !important;
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
                        <img src="<?= base_url('uploads/pengumuman/' . $pengumuman['gambar']) ?>" alt="<?= $pengumuman['judul'] ?>" class="w-100">
                    </div>
                    <h2 class="entry-title">
                        <?= $pengumuman['judul'] ?>
                    </h2>
                    <div class="entry-meta">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#"><?= $pengumuman['namalengkap'] ?></a></li>
                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="<?= tanggal_indo($pengumuman['tgl_publikasi']); ?>"><?= tanggal_indo($pengumuman['tgl_publikasi']); ?></time></a></li>
                            <li class="d-flex align-items-center"><i class="bi bi-eye"></i> <?= $pengumuman['views'] ?></li>
                        </ul>
                    </div>
                    <div class="entry-content my-3">
                        <?= $pengumuman['isi'] ?>
                        <?php if (!empty($pengumuman['link'])): ?>
                            <a href="<?= $pengumuman['link'] ?>" class="btn btn-info text-light" target="_blank">
                                <i class="bi bi-cloud px-2"></i>Unduh Pengumuman
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="entry-footer">
                        <i class="bi bi-folder"></i>
                        <ul class="cats">
                            <li><?= $pengumuman['kategori'] ?></li>
                        </ul>
                        <i class="bi bi-tags"></i>
                        <ul class="tags">
                            <?php foreach ($uniqueTags as $tag) : ?>
                                <li><a href="<?= base_url('pengumuman/tag_pengumuman/' . trim($tag)) ?>"><?= trim($tag) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </article>
            </div>

            <div class="col-lg-4">
                <div class="sidebar">
                    <h3 class="sidebar-title">Pengumuman Lainnya</h3>
                    <div class="sidebar-item recent-posts">
                        <?php if (empty($recentPosts)) : ?>
                            <p class="text-muted">Belum ada data untuk ditampilkan di halaman ini.</p>
                        <?php else : ?>
                            <?php foreach ($recentPosts as $post) : ?>
                                <div class="post-item clearfix">
                                    <img src="<?= base_url('uploads/pengumuman/' . $post['gambar']); ?>" alt="<?= $post['judul']; ?>">
                                    <h4><a href="<?= $post['slug']; ?>"><?= substr(strip_tags($post['judul']), 0, 50) ?> ...</a></h4>
                                    <time datetime="<?= tanggal_indo($post['tgl_publikasi']); ?>"><?= tanggal_indo($post['tgl_publikasi']); ?></time>
                                </div>
                                <hr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <h3 class="sidebar-title">Tags</h3>
                    <div class="sidebar-item tags">
                        <ul>
                            <?php if (empty($uniqueTags)) : ?>
                                <p class="text-muted">Belum ada data untuk ditampilkan di halaman ini.</p>
                            <?php else : ?>
                                <?php if (isset($uniqueTags)) : ?>
                                    <?php foreach ($uniqueTags as $tag) : ?>
                                        <li><a href="<?= base_url('pengumuman/tag_pengumuman/' . trim($tag)) ?>"><?= trim($tag) ?></a></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>