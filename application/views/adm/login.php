<div class="col-md-4"></div>
<div class="col-md-4">
    <?php
    $attributes = array('role' => 'form');
    echo form_open(base_url() . 'login/checkLogin', $attributes);
    if (isset($alertMessage)) {
        ?>
        <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Oh sheet!</strong> <?php echo $alertMessage; ?>
        </div>
    <?php } ?>
    <input type="hidden" name="formLogin" value="formLogin">
    <h2 class="form-signin-heading">Please sign in</h2>
    <div class="form-group">
        <label for="User">User</label>
        <input type="text" name="user" class="form-control" placeholder="User" required="" autofocus="">
    </div>
    <div class="form-group">
        <label for="Password">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required="">
    </div>
    <div class="form-group">
        <label class="checkbox">
            <input type="checkbox" name="remember"> Maintain session
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
</div>
<div class="col-md-4"></div>