<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php include viewPath('web/template/header'); ?>

<style>
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .news-card {
        border-radius: 8px;
    }

    .news-feed-image {
        border-radius: 8px;
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .col-lg-12 .news-feed-image {
        border-radius: 8px;
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .date {
        font-size: 12px;
    }

    .username {
        color: blue;
    }

    .share {
        color: blue;
    }

    section#portfolio {
        margin-top: 120px;
    }

    .sidebar h5 {
        background-color: #283a5a;
        color: #fff;
        padding: 10px;
    }

    .sidebar a {
        text-decoration: none;
        color: #283a5a;
    }

    .sidebar a:hover {
        color: #007bff;
    }

    .tag li a {
        background-color: #283a5a;
        padding: 5px 15px;
        color: #fff;
        text-decoration: none;
        margin: 10px 0;
    }

    .tag li a:hover {
        color: #007bff;
    }

    .tag li {
        list-style: none;
    }

    .tag {
        display: flex;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .social-list {

        display: flex;
        justify-content: flex-end;
        align-items: center;
    }


    .social-list li {

        list-style: none;
        margin-right: 10px;
    }

    .social-list li a {
        text-decoration: none;
    }

    .social-list li a:hover {
        background-color: #007bff;
        color: #888;
    }

    .maincard {
        position: relative;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .thecard {
        position: absolute;
        width: 100%;
        height: 100%;
    }


    .thefront {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: hidden;

        color: #fff;
        border-radius: 10px;
        cursor: pointer;
        border: 1px solid #eee;
        box-shadow: 5px 6px 6px 2px #e9ecef;
        padding: 4px
    }

    .theback {
        position: absolute;
        width: 100%;
        height: 100%;
        cursor: pointer;
        background-color: hidden;

        color: #fff;
        border-radius: 10px;
        border: 1px solid #eee;
        box-shadow: 5px 6px 6px 2px #e9ecef;
        padding: 4px
    }

    .social-text small {

        font-size: 20px;
    }


    @media (max-width:700px) {
        .social-list {

            display: block;
        }
    }

    .facebook {
        background: #3b5998;
    }

    .twitter {
        background: #1c96e8;
    }

    .envelope {
        background: #d54338;
    }

    .whatsapp {

        background: #4dc247;

    }

    .thefront.text-center {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 !important;
    }

    ul.social-list {
        display: flex;
    }

    .isiberita {
        padding: 0 20px !important;
    }

    .row.tagsidebar ul {
        list-style: none;
        display: block;
        width: 100%;
    }

    .row.tagsidebar ul li {
        width: auto;
        display: inline-flex;
        background-color: #283a5a;
        margin: 4px 0;
    }

    .row.tagsidebar ul li a {
        color: #fff;
        padding: 5px 15px;
        text-decoration: none;
    }

    .row.tagsidebar ul li a:hover {
        color: #007bff;
    }
</style>

<main id="main">
    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-9 isiberita">
                    <div class="d-flex flex-row"></div>
                    <h2 class="text-capitalize"><?php echo $detailberita->judul; ?></h2>
                    <p class="text-primary">
                        <i class="bx bxl-calendar text-secondary"></i> <?php echo longdate_indo(substr($detailberita->tgl_publikasi, 0, 10)); ?>
                    </p>
                    <div class="row news-card mt-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 mb-4 mt-3">
                            <div class="feed-image"><img class="news-feed-image rounded img-fluid img-responsive" src="<?php echo base_url('uploads/informasi/berita/' . $detailberita->gambar); ?>"></div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                            <div class="news-feed-text">
                                <?php echo $detailberita->isi; ?>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6 m-0">
                                    <div class="tag">
                                        <p>Tag:</p>
                                        <ul>
                                            <li>
                                                <?php
                                                $tags = $detailberita->tags;
                                                $tagsarray = explode(",", $tags);
                                                foreach ($tagsarray as $tag) :
                                                ?>
                                                    <a href="<?php echo site_url('tag/') . trim($tag); ?>"><?php echo trim($tag); ?></a>
                                                <?php endforeach; ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6 m-0">
                                    <div class="row">
                                        <ul class="social-list">
                                            <li>
                                                <a href="#">
                                                    <div class="maincard p-3">
                                                        <div class="thecard">
                                                            <div class="thefront text-center facebook">
                                                                <div class="social-icon">
                                                                    <i class="bx bxl-facebook"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>


                                            <li>
                                                <a href="#">
                                                    <div class="maincard p-3">
                                                        <div class="thecard">
                                                            <div class="thefront text-center py-4 twitter">
                                                                <div class="social-icon">
                                                                    <i class="bx bxl-twitter"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <div class="maincard p-3">
                                                        <div class="thecard">
                                                            <div class="thefront text-center py-4 envelope">
                                                                <div class="social-icon">
                                                                    <i class="bi bi-envelope"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>


                                            <li>
                                                <a href="#">
                                                    <div class="maincard p-3">
                                                        <div class="thecard">
                                                            <div class="thefront text-center py-4 whatsapp">
                                                                <div class="social-icon">
                                                                    <i class="bx bxl-whatsapp"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3 sidebar">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="row sidebar">
                                <h5>Kategori Informasi</h5>
                            </div>
                            <div class="row">
                                <ul>
                                    <a href="<?php echo site_url('berita'); ?>">Berita<span> (<?php echo $count_berita; ?>)</span></a><br>
                                    <a href="<?php echo site_url('pengumuman'); ?>">Pengumuman<span> (<?php echo $count_pengumuman; ?>)</span></a><br>
                                    <a href="<?php echo site_url('pelatihan'); ?>">Pelatihan<span> (<?php echo $count_pelatihan; ?>)</span></a><br>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="row sidebar">
                                <h5>Tags</h5>
                            </div>
                            <div class="row tagsidebar">
                                <ul>
                                    <?php foreach ($tags_sidebar as $x) : ?>
                                        <li><a href="<?php echo site_url('tag/') . $x; ?>"><?php echo $x; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include viewPath('web/template/footer'); ?>