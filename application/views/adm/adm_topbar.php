<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">LaRutaDelGinTonic</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo base_url(); ?>adm">Dashboard</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">User<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">My profile</a></li>
                        <li><a href="<?php echo base_url(); ?>register">Register new</a></li>
                    </ul>
                </li>
            </ul>
            <?php
            echo form_open(base_url() . 'login/checkLogin')
            ?>
            <input type="hidden" name="logout" value="logout">
            <p>
                <button type="submit" name="submit" class="btn btn-warning pull-right">Sign out</button>
            </p>
            </form>
        </div><!--/.nav-collapse -->
    </div>
</div>