<?php
if (isset($invalid_results)) {
    ?>
    <div class="warning"><h2>Debes introducir algo valido para buscar.</h2></div>
    <button type="button" class="back btn"><span class="glyphicon glyphicon-backward"></span> Atras</button>
    <?php
} elseif (isset($not_results)) {
    ?>
    <div class="warning"><h2>No hubo ningun resultado para la busqueda "<?php echo $keyword ?>".</h2></div>
    <button type="button" class="back btn"><span class="glyphicon glyphicon-backward"></span> Atras</button>
    <?php
} elseif (isset($results)) {
    foreach ($results as $key=>$row) {
        ?>
    <div class="search-result">
        <a href="<?php echo base_url() . 'bares/' . $row->slug;?>"><span><?php echo $key ?></span><?php echo $row->title ?></a>
        <p><?php echo $row->text ?></p>
    </div>
    <?php
    }
} else {
    show_404();
}
?>
