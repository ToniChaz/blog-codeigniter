<div class="content">
    <div class="col-left">
        <p>Gin Tonics por Barrios</p>
        <p>Ginebras para dar y tomar</p>
        <p>Vota tu favorito</p>
    </div>
    <div class="col-right">
        <article>
            <h1><?php echo $last_post->title; ?></h1>
            <div class="post-detail">
                <p><span class="glyphicon glyphicon-user"></span> <?php echo $last_post->author; ?></p>
                <p><span class="glyphicon glyphicon-calendar"></span> <?php echo $last_post->date; ?></p>
                <p><span class="glyphicon glyphicon-euro"></span> <?php echo $last_post->price; ?></p>
                <p><span class="glyphicon glyphicon-star"></span> <?php echo $last_post->vote; ?></p>            
            </div>
            <div class="post-text"><?php echo $last_post->text; ?></div>
            <a href="bares/<?php echo $last_post->slug; ?>" title="<?php echo $last_post->title; ?>">Ir al post <span class="glyphicon glyphicon-forward"></span></a>
        </article>
    </div>
</div>
<div class="index-footer">
    <div class="col">
        <p>La receta de paquito perez</p>
        <iframe width="230" src="//www.youtube.com/embed/QBafshkmOik" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="col"><p>Consigue tu descuento</p></div>
    <div class="col"><p>Envia tu review</p></div>
    <div class="col"><p>Facebook</p><p>Twitter</p><p>Google+</p></div>
</div>