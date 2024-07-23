<?= $this->extend('frontend/template') ?>
<?= $this->section('content') ?>

<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
        </div>
    </div>
</section>

<section class="py-3 py-md-5">
    <div class="container overflow-hidden">
        <div class="section-title">
            <h2>Berita</h2>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>
        <div class="row gy-4 gy-lg-0">
            <?php foreach ($informasi as $item) : ?>
                <div class="col-12 col-lg-4">
                    <article>
                        <div class="card border-0">
                            <figure class="card-img-top m-0 overflow-hidden bsb-overlay-hover">
                                <a href="<?= base_url('berita/' . $item['slug']) ?>">
                                    <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy" src="<?= base_url('uploads/berita/' . $item['gambar']) ?>" alt="<?= $item['kategori'] ?>">
                                </a>
                                <figcaption>
                                    <i class="bi bi-eye-fill"></i>
                                    <h4 class="h6 text-white bsb-hover-fadeInRight mt-2">Selengkapnya ...</h4>
                                </figcaption>
                            </figure>
                            <div class="card-body border bg-white p-4">
                                <div class="entry-header mb-3">
                                    <h2 class="card-title entry-title h4 mb-0">
                                        <a class="link-dark text-decoration-none" href="<?= base_url('berita/' . $item['slug']) ?>"><?= $item['judul'] ?></a>
                                    </h2>
                                </div>
                                <p class="card-text entry-summary text-secondary">
                                    <?= substr(strip_tags($item['isi']), 0, 150) ?>...
                                </p>
                            </div>
                            <div class="card-footer border border-top-0 bg-white p-4">
                                <ul class="entry-meta list-unstyled d-flex align-items-center m-0">
                                    <li>
                                        <a class="fs-7 link-secondary text-decoration-none d-flex align-items-center" href="#!">
                                            <i class="bi bi-calendar-check-fill"></i>
                                            <span class="ms-2 fs-7"><?= date('d M Y', strtotime($item['tgl_publikasi'])) ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>