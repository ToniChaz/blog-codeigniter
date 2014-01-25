<?php
$attributes = array('role' => 'form', 'class' => 'form-signin');
echo form_open(base_url() . 'login/checkLogin', $attributes);
if (isset($formLoginError)) {
    ?>
    <div class="alert alert-danger">
        <strong>Oh sheet!</strong> <?php echo $formLoginError; ?>
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
<label class="checkbox">
    <input type="checkbox" value="remember-me"> Remember me
</label>
<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>