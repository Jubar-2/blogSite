<?= $this->extend('./components/index.php') ?>
<?= $this->section('content') ?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<?= $this->include('./components/bannar.php') ?>
<?php $pager = \Config\Services::pager(); ?>
<section class="blog-posts grid-system">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="all-blog-posts">
                    <div class="row">
                        <?php foreach ($data as $data) : ?>
                            <div class="col-lg-6">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img style="height: 220px;" src="<?= base_url('images/' . $data->userName . "/post/" . $data->image) ?>" alt="">
                                    </div>
                                    <div class="down-content">

                                        <a href="<?= base_url('postDetails/' . $data->post_id) ?>">
                                            <h4 class="sm-str-title"><?= $data->title ?></h4>
                                        </a>
                                        <ul class="post-info">
                                            <li><a href="<?= base_url('profile/' . $data->userName) ?>"><?= $data->fast_name . " " . $data->Last_name; ?></a></li>
                                            <li><a href="#"><?= view_cell('App\Libraries\DateSnippets::humanDate', ['date' => $data->created_at, 'timezoon' => 'asia/dhaka'])  ?></a></li>
                                            <li><a href="<?= base_url('profile/' . $data->userName) ?>"><?= $data->comment; ?> Comments</a></li>
                                        </ul>
                                        <p class="p-text"><?= $data->text ?></p>
                                        <div class="post-options">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <ul class="post-tags">
                                                        <li><a href="#">Facebook</a>,</li>
                                                        <li><a href="#"> Twitter</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-lg-12">
                            <?= $pager->links('default', 'pager') ?>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->include('./components/sidebar.php') ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>