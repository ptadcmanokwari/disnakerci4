<?= $this->extend('frontend/template') ?>

<?= $this->section('content') ?>
<style>
    #listBerita {
        border: 1px solid #116db6;
        border-radius: 10px;
    }
</style>
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>About</h2>
            <ol>
                <li><a href="index.html">Home</a></li>
                <li>About</li>
            </ol>
        </div>

    </div>
</section>
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Pengumuman</h2>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>
        <div class="row mt-4">
            <div class="col-lg-8">
                <?php if (empty($informasi)) : ?>
                    <p class="text-center text-muted">Belum ada data untuk ditampilkan di halaman ini.</p>
                <?php else : ?>
                    <?php foreach ($informasi as $info) : ?>
                        <div id="listBerita" class="row py-2 my-2">
                            <div class="col-lg-4">
                                <div class="entry-img">
                                    <img src="<?= base_url('uploads/pengumuman/' . $info['gambar']); ?>" alt="" class="img-fluid">
                                </div>
                            </div>
                            <article class="col-lg-8 entry py-0 shadow-none">
                                <h2 class="entry-title">
                                    <a href="<?= base_url('informasi/' . $info['slug']); ?>"><?= $info['judul']; ?></a>
                                </h2>
                                <div class="entry-meta">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#"><?= $info['users_id']; ?></a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="<?= $info['tgl_publikasi']; ?>"><?= date('M d, Y', strtotime($info['tgl_publikasi'])); ?></time></a></li>
                                    </ul>
                                </div>
                                <div class="entry-content">
                                    <p>
                                        <?= character_limiter($info['isi'], 150); ?>
                                    </p>
                                    <div class="read-more">
                                        <a href="<?= base_url('informasi/' . $info['slug']); ?>">Read More</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>

                    <div class="blog-pagination d-flex justify-content-center">
                        <?php if ($pager) : ?>
                            <?= $pager->links() ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="col-lg-4 py-0">
                <div class="sidebar py-0">
                    <h3 class="sidebar-title">Pengumuman Terbaru</h3>
                    <div class="sidebar-item recent-posts">
                        <?php if (empty($recentPosts)) : ?>
                            <p class="text-muted">Belum ada data untuk ditampilkan di halaman ini.</p>
                        <?php else : ?>
                            <?php foreach ($recentPosts as $post) : ?>
                                <div class="post-item clearfix">
                                    <img src="<?= base_url('uploads/pengumuman/' . $post['gambar']); ?>" alt="">
                                    <h4><a href="<?= base_url('informasi/' . $post['slug']); ?>"><?= $post['judul']; ?></a></h4>
                                    <time datetime="<?= $post['tgl_publikasi']; ?>"><?= date('M d, Y', strtotime($post['tgl_publikasi'])); ?></time>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div><!-- End sidebar recent posts-->

                    <h3 class="sidebar-title">Tags</h3>
                    <div class="sidebar-item tags">
                        <ul>
                            <?php if (empty($uniqueTags)) : ?>
                                <p class="text-muted">Belum ada data untuk ditampilkan di halaman ini.</p>
                            <?php else : ?>
                                <?php if (isset($uniqueTags)) : ?>
                                    <?php foreach ($uniqueTags as $tag) : ?>
                                        <li><a href="#"><?= trim($tag); ?></a></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </div><!-- End sidebar tags -->
                </div><!-- End sidebar -->
            </div>
        </div>
</section>
<?= $this->endSection() ?>