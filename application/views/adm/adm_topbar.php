<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>" title="Visitar web">LaRutaDelGinTonic</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url(); ?>adm">Dashboard</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Post<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>post">My posts</a></li>
                        <li><a href="<?php echo base_url(); ?>create">New post</a></li>
                        <?php if ($this->session->userdata('role') == 0) { ?>
                        <li><a href="<?php echo base_url(); ?>post/all">All posts</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">User<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>profile">My profile</a></li>
                        <?php if ($this->session->userdata('role') == 0) { ?>
                        <li><a href="<?php echo base_url(); ?>register">Register new</a></li>
                        <li><a href="<?php echo base_url(); ?>users">All users</a></li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
            <?php
            $attributes = array('role' => 'form', 'class' => 'navbar-form navbar-right');
            echo form_open(base_url() . 'login/check_login', $attributes)
            ?>
            <input type="hidden" name="logout" value="logout">
            <button type="submit" name="submit" class="btn btn-warning">Sign out</button>
            </form>
        </div><!--/.nav-collapse -->
    </div>
</div>