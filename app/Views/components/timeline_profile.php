<?php $pager = \Config\Services::pager(); ?>
<section class="blog-posts grid-system mt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php if (other($userName)) : ?>
                    <form method="post" class="mb-5" action="<?= base_url('post') ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Title</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Example file input</label>
                            <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Text</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text"></textarea>
                        </div>
                        <input class="sub-button" type="submit" value="post">
                    </form>
                <?php endif ?>
                <div class="all-blog-posts">
                    <div class="row">
                        <?php foreach ($data as $data) : ?>
                            <?php if ($data['text']) : ?>
                                <div class="col-lg-12">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <img src="<?= base_url('images/' . $data['userName'] . "/post/" . $data['image']) ?>" alt="">
                                        </div>
                                        <div class="down-content">
                                            <a href="<?= base_url('postDetails/' . $data['post_id']) ?>">
                                                <h4><?= $data['title'] ?></h4>
                                            </a>
                                            <ul class="post-info">
                                                <li><a href="<?= base_url('profile/' . $data['userName']) ?>"><?= $data['fast_name'] . " " . $data['Last_name']; ?></a></li>
                                                <li><a>
                                                        <?= view_cell('App\Libraries\DateSnippets::humanDate', ['date' => $data['created_at'], 'timezoon' => 'asia/dhaka'])  ?>
                                                    </a></li>
                                                <li><a href="<?= base_url('postDetails/' . $data['post_id']) ?>"><?= $data['comment']; ?> Comments</a></li>
                                            </ul>
                                            <p>
                                                <?= $data['text'] ?>
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
                            <?php else : ?>
                                <div class="col-lg-12 mb-5 text-center">
                                    <h5>No post ableble</h5>
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>

                        <div class="col-lg-12">
                            <?= $pager->links('default', 'pager') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>