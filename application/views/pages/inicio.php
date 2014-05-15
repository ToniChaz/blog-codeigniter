<div class="content">
    <div class="col-left">
        <p>Gin Tonics por Barrios</p>
        <p>Ginebras para dar y tomar</p>
        <p>Vota tu favorito</p>
    </div>
    <div class="col-right">
        <h1><?php echo $lastPost->title; ?></h1>
        <div class="post-detail">
            <p><span class="glyphicon glyphicon-user"></span> <?php echo $lastPost->author; ?></p>
            <p><span class="glyphicon glyphicon-calendar"></span> <?php echo $lastPost->date; ?></p>
            <p><span class="glyphicon glyphicon-euro"></span> <?php echo $lastPost->price; ?></p>
            <p><span class="glyphicon glyphicon-star"></span> <?php echo $lastPost->vote; ?></p>            
        </div>
        <div class="post-text"><?php echo $lastPost->text; ?></div>
        <a href="bares/<?php echo $lastPost->slug; ?>" title="<?php echo $lastPost->title; ?>">Ir al post <span class="glyphicon glyphicon-forward"></span></a>
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