<?php
if (isset($alert_message)) {
    ?>
    <div class="alert <?php if (isset($class)) echo $class; ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $alert_message; ?>
    </div>
    <?php
}
$attributes = array('role' => 'form', 'class' => 'form-update');
echo form_open_multipart(base_url() . 'profile/check_profile_data', $attributes);
?>
<div class="row">
    <div class="col-md-3">
        <img src="<?php echo base_url() . "media/avatar/thumb/" . $profile["avatarurl"] ?>" alt="<?php echo $profile["name"] . " " . $profile["surname"] ?> | Avatar" class="img-thumbnail avatar" />
    </div>
    <div class="col-md-6">
        <h2>Hi <?php echo $profile["name"] . " " . $profile["surname"] ?>, update your profile data.</h2>
        <div class="form-group">
            <label for="User">User</label>
            <input type="text" name="user" class="form-control" value="<?php echo $profile["user"] ?>" required="" readonly="" maxlength="50">
        </div>
        <div class="form-group">
            <label for="Password">Password *</label>
            <input type="password" name="password" class="form-control" maxlength="30">
        </div>
        <div class="form-group">
            <label for="Name">Name *</label>
            <input type="text" name="name" class="form-control" value="<?php echo $profile["name"] ?>" required="" maxlength="50">
        </div>
        <div class="form-group">
            <label for="Surname">Surname *</label>
            <input type="text" name="surname" class="form-control" value="<?php echo $profile["surname"] ?>" required="" maxlength="50">
        </div>
        <div class="form-group">
            <label for="Email">Email *</label>
            <input type="email" name="email" class="form-control" value="<?php echo $profile["email"] ?>" required="" maxlength="50">
        </div>
        <div class="form-group">
            <label for="Avatar">Avatar</label>
            <input type="file" name="userfile" class="form-control" >
            <p class="help-block">Only (gif, jpg, jpeg, png) and maximum size 2Mb</p>
        </div>
        <div class="form-group">
            <label for="URL">URL</label>
            <input type="url" name="url" class="form-control" value="<?php echo $profile["url"] ?>" >
        </div>
        <div class="form-group">                     
            <button class="btn btn-lg btn-danger" id="onDeleteProfile" data-id="<?php echo $profile["id"]; ?>" data-toggle="modal" data-target="#modal">Delete</button>
            <button class="btn btn-lg btn-success" type="submit" name="update">Update</button>
        </div>
    </div>
</form>
<div class="col-md-3"></div>
</div>    

