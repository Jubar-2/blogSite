<?= $this->extend('./components/index.php') ?>
<?= $this->section('content') ?>
<?= $this->include('./components/bannar.php') ?>
<!-- Banner Ends Here -->
<section class="blog-posts grid-system">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="all-blog-posts">
                    <div class="row">
                        <?php foreach ($singelData as $data) : ?>
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="<?= base_url('images/' . $data->userName . "/post/" . $data->image) ?>" alt="">
                                    </div>
                                    <div class="down-content">

                                        <a href="post-details.html">
                                            <h4><?= $data->title ?></h4>
                                        </a>
                                        <ul class="post-info">
                                            <li><a href="<?= base_url('profile/' . $data->userName) ?>"><?= $data->fast_name . " " . $data->Last_name; ?></a></li>
                                            <li><a>
                                                    <?= view_cell('App\Libraries\DateSnippets::humanDate', ['date' => $data->created_at, 'timezoon' => 'asia/dhaka'])  ?>
                                                </a></li>
                                            <li><a href="#commentFild"><?= $data->comment; ?> Comments</a></li>
                                        </ul>
                                        <p>
                                            <?= $data->text ?>
                                        </p>
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
                            <div class="sidebar-item comments">
                                <div class="sidebar-heading">
                                    <h2><?= $data->comment ?> comments</h2>
                                </div>
                                <div class="content">
                                    <ul>
                                        <?php foreach ($dataComment as $dataComment) : ?>
                                            <li>
                                                <div class="author-thumb">
                                                    <img src="<?= base_url($dataComment->profilePicture == null ? 'assets/images/dummy450x450.jpg' : 'images/' . $userName . '/profile/' . $dataComment->profilePicture) ?>" alt="">
                                                </div>
                                                <div class="right-content">
                                                    <h4><?= $dataComment->fullName ?><span> <?= view_cell('App\Libraries\DateSnippets::humanDate', ['date' => $dataComment->created_at, 'timezoon' => 'asia/dhaka'])  ?></span></h4>
                                                    <p><?= $dataComment->comment ?></p>
                                                </div>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php if (loggedIn()) : ?>
                            <div class="col-lg-12">
                                <div id="commentFild" class="sidebar-item submit-comment">
                                    <div class="sidebar-heading">
                                        <h2>Your comment</h2>
                                    </div>
                                    <div class="content">
                                        <form id="comment" action="<?= base_url('comment/' . $data->post_id) ?>" method="post">
                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <fieldset>
                                                        <textarea name="comment" rows="6" id="message" placeholder="Type your comment" required=""></textarea>
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-12">
                                                    <fieldset>
                                                        <button type="submit" id="form-submit" class="main-button">Submit</button>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <?= $this->include('./components/sidebar.php')
            ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>