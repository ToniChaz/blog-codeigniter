<?php
if (!empty($view_posts)) {
    foreach ($view_posts as $posts) {
        if ($posts['status'] == 1) {
            ?>
            <article class="multi-article">
                <div>
                    <h1><?php echo $posts['title'] ?></h1>
                    <div>
                        <?php echo $posts['text'] ?>
                    </div>
                    <p><a href="<?php echo base_url(); ?>bares/<?php echo $posts['slug'] ?>">Ir al post <span class="glyphicon glyphicon-forward"></a></p>
                </div>
            </article>
            <?php
        }
    }
} else if (!empty($view_post) && $view_post->status == 1) {
    ?>
    <article>
        <div>
            <h1><?php echo $view_post->title ?></h1>
            <div class="post-detail">
                <p><span class="glyphicon glyphicon-user"></span> <?php echo $view_post->author; ?></p>
                <p><span class="glyphicon glyphicon-calendar"></span> <?php echo $view_post->date; ?></p>
                <p><span class="glyphicon glyphicon-euro"></span> <?php echo $view_post->price; ?></p>
                <p><span class="glyphicon glyphicon-star"></span> <?php echo $view_post->vote; ?></p>            
            </div>
            <div>
                <?php echo $view_post->text ?>
            </div>
            <p><button type="button" class="back btn"><span class="glyphicon glyphicon-backward"></span> Atras</button></p>
        </div>
    </article>
    <?php
} else {
    show_404();
}
?>