<div class="col-lg-4">
    <div class="sidebar">
        <div class="row">

            <div class="col-lg-12">
                <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                        <h2>Recent Posts</h2>
                    </div>
                    <div class="content">
                        <ul>
                            <?php foreach ($data as $data) : ?>

                                <li><a href="<?= base_url('postDetails/' . $data->post_id) ?>">
                                        <h5 class="sm-str-title"><?= $data->title ?></h5>
                                        <span> <?= view_cell('App\Libraries\DateSnippets::humanDate', ['date' => $data->created_at, 'timezoon' => 'asia/dhaka'])  ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>