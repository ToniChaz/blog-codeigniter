<div class="col-md-3"></div>
<div class="col-md-6">
    <?php
    if (isset($alertMessage)) {
        ?>
        <div class="alert alert-danger">
            <strong>Oh sheet!</strong> <?php echo $alertMessage; ?>
        </div>
        <?php
    }
    $attributes = array('role' => 'form', 'class' => 'form-signin');
    echo form_open_multipart(base_url() . 'register/checkRegister', $attributes);
    ?>
    <h2 class="form-signin-heading">Register new user</h2>
    <div class="form-group">
        <label for="User">User *</label>
        <input type="text" name="user" class="form-control" placeholder="User" required="" autofocus="">
    </div>
    <div class="form-group">
        <label for="Password">Password *</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required="">
    </div>
    <div class="form-group">
        <label for="Name">Name *</label>
        <input type="text" name="name" class="form-control" placeholder="Name" required="">
    </div>
    <div class="form-group">
        <label for="Surname">Surname *</label>
        <input type="text" name="surname" class="form-control" placeholder="Surname" required="">
    </div>
    <div class="form-group">
        <label for="Email">Email *</label>
        <input type="email" name="email" class="form-control" placeholder="E-mail" required="">
    </div>
    <div class="form-group">
        <label for="Avatar">Avatar</label>
        <input type="file" name="userfile" class="form-control" >
        <p class="help-block">Only (gif, jpg, jpeg, png) and maximum size 2Mb</p>
    </div>
    <div class="form-group">
        <label for="URL">URL</label>
        <input type="url" name="url" class="form-control" placeholder="http://www.example.com" >
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
</form>
</div>
<div class="col-md-3"></div>