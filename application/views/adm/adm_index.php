<?php
if (isset($alertMessage)) {
    ?>
    <div class="alert <?php echo $class; ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $alertMessage; ?>
    </div>
<?php } ?>
<div class="jumbotron">
    <h1>Bienvenido al club!</h1>
    <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
    <p><a href="#" class="btn btn-primary btn-lg" role="button">Learn more »</a></p>
</div>