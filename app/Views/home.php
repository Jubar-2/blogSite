<?= $this->extend('./components/index.php') ?>
<?= $this->section('content') ?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">
            <?php foreach ($data as $shortData) : ?>
                <div class="item">
                    <img style="height:240px" src="<?= base_url('images/' . $shortData->userName . "/post/" . $shortData->image) ?>" alt="">
                    <div class="item-content">
                        <div class="main-content">

                            <a href="<?= base_url('postDetails/' . $shortData->post_id) ?>">
                                <h4 class="sm-str-title"><?= $shortData->title ?></h4>
                            </a>
                            <ul class="post-info">
                                <li><a href="<?= base_url('profile/' . $shortData->userName) ?>"><?= $shortData->fast_name . " " . $shortData->Last_name; ?></a></li>
                                <li><a> <?= view_cell('App\Libraries\DateSnippets::humanDate', ['date' => $shortData->created_at, 'timezoon' => 'asia/dhaka'])  ?></a></li>
                                <li><a href="<?= base_url('profile/' . $shortData->userName) ?>"><?= $shortData->comment; ?> Comments</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Banner Ends Here -->

<section class="blog-posts">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="all-blog-posts">
                    <div class="row">
                        <?php foreach ($data as $data) : ?>
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="<?= base_url('images/' . $data->userName . "/post/" . $data->image) ?>" alt="">
                                    </div>
                                    <div class="down-content">

                                        <a href="<?= base_url('postDetails/' . $data->post_id) ?>">
                                            <h4 class="str-title"><?= $data->title ?></h4>
                                        </a>
                                        <ul class="post-info">
                                            <li><a href="<?= base_url('profile/' . $data->userName) ?>"><?= $data->fast_name . " " . $data->Last_name; ?></a></li>
                                            <li><a>
                                                    <?= view_cell('App\Libraries\DateSnippets::humanDate', ['date' => $data->created_at, 'timezoon' => 'asia/dhaka'])  ?>
                                                </a></li>
                                            <li><a href="<?= base_url('profile/' . $data->userName) ?>"><?= $data->comment; ?> Comments</a></li>
                                        </ul>
                                        <p><?= $data->text ?></p>
                                        <div class="post-options">
                                            <div class="row">
                                                <div class="col-6">

                                                </div>
                                                <div class="col-6">
                                                    <ul class="post-share">
                                                        <li><i class="fa fa-share-alt"></i></li>
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
                            <div class="main-button">
                                <a href="<?= base_url('blogEntries') ?>">View All Posts</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->include('./components/sidebar.php') ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>