<?= $this->extend('frontend/template') ?>

<?= $this->section('content') ?>
<style>
    section#portfolio {
        margin-top: 120px;
        padding-top: 60px !important;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    /* Track */

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */

    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    body {
        background: #eee;
    }

    .barto {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
        color: #ffffff;
        float: left;
        font-family: 'Lato', Arial, sans-serif;
        font-size: 16px;
        margin: 10px 1%;
        overflow: hidden;
        position: relative;
        text-align: left;
        width: 100%;
    }

    .barto * {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-transition: all 0.25s ease;
        transition: all 0.25s ease;
    }

    .barto img {
        width: 100%;
        vertical-align: top;
        position: relative;
        object-fit: cover;
        height: 400px;
    }

    .barto figcaption {
        padding: 25px 20px 25px;
        position: absolute;
        bottom: 0;
        z-index: 1;
    }

    .barto figcaption:before {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: #700877;
        content: '';
        background: -moz-linear-gradient(90deg, #700877 0%, #ff2759 100%, #ff2759 100%);
        background: -webkit-linear-gradient(90deg, #700877 0%, #ff2759 100%, #ff2759 100%);
        background: linear-gradient(90deg, #700877 0%, #ff2759 100%, #ff2759 100%);
        opacity: 0.8;
        z-index: -1;
    }

    .barto .date {
        background-color: #fff;
        border-radius: 50%;
        color: #700877;
        font-size: 18px;
        font-weight: 700;
        min-height: 48px;
        min-width: 48px;
        padding: 10px 0;
        position: absolute;
        right: 15px;
        text-align: center;
        text-transform: uppercase;
        top: -25px;
    }

    .barto .date span {
        display: block;
        line-height: 14px;
    }

    .barto .date .month {
        font-size: 11px;
    }

    .barto h3,
    .barto p {
        margin: 0;
        padding: 0;
    }

    .barto h3 {
        display: inline-block;
        font-weight: 700;
        letter-spacing: -0.4px;
        margin-bottom: 5px;
    }

    .barto p {
        font-size: 0.8em;
        line-height: 1.6em;
        margin-bottom: 0px;
    }

    .barto a {
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        position: absolute;
        z-index: 1;
    }

    .barto:hover img,
    .barto.hover img {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

    img {
        border-radius: 5px;
    }

    img {
        border-radius: 5px;
    }

    section#portfolio .row {
        justify-content: center;
    }
</style>
<main id="main">

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="section-title">
                <h2>Berita</h2>
            </div>

            <div class="row">
                <?php foreach ($informasi as $info) : ?>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <figure class="barto">
                            <div class="image">
                                <img src="<?= base_url('uploads/berita/' . $info['gambar']); ?>" alt="<?= $info['judul']; ?>" class="img-fluid">
                            </div>
                            <figcaption>
                                <div class="date">
                                    <span class="day">
                                        <?= date('d', strtotime($info['tgl_publikasi'])); ?>
                                    </span>
                                    <span class="month">
                                        <?= date('M', strtotime($info['tgl_publikasi'])); ?>
                                    </span>
                                </div>
                                <h3><?= $info['judul']; ?></h3>
                                <p><?= character_limiter($info['isi'], 150); ?></p>
                            </figcaption>
                            <a href="<?php echo site_url('berita/') . $info['slug']; ?>"></a>
                        </figure>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section><!-- End Portfolio Section -->

</main><!-- End #main -->
<?= $this->endSection() ?>