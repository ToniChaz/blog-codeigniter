<?php
if (!empty($viewPosts)) {
    foreach ($viewPosts as $posts) {
        if ($posts['status'] == 1) {
            ?>
            <article>
                <div class="hero-unit">
                    <h2><?php echo $posts['title'] ?></h2>
                    <div>
                        <?php echo $posts['text'] ?>
                    </div>
                    <p><a href="<?php echo base_url(); ?>bares/<?php echo $posts['slug'] ?>" class="btn btn-primary">View article</a></p>
                </div>
            </article>
            <?php
        }
    }
} else if (!empty($viewPost) && $viewPost->status == 1) {
    ?>
    <article>
        <div class="hero-unit">
            <h2><?php echo $viewPost->title ?></h2>
            <p><?php echo $viewPost->author ?></p>
            <p><?php echo $viewPost->date ?></p>
            <p><?php echo $viewPost->price ?></p>
            <div>
                <?php echo $viewPost->text ?>
            </div>
            <p><a href="<?php echo base_url(); ?>bares/" class="btn btn-primary">Back</a></p>
        </div>
    </article>
    <?php
}else{
    show_404();
}
?>