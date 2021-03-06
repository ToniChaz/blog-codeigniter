<?php
if (isset($alert_message)) {
    ?>
    <div class="alert <?php echo $class; ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $alert_message; ?>
    </div>
<?php } ?>
<div class="table-responsive">
<table class="table table-bordered table-striped table-users">
    <thead>
        <tr>
          <th>Avatar</th>
          <th>Username</th>
          <th>Name</th>
          <th>Surame</th>
          <th>E-mail</th>
          <th>Role</th>
          <th>Update</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($all_users as $user) { ?>
        <tr>        
            <?php 
            $attributes = array('role' => 'form', 'id' => 'form' . $user->id);
            echo form_open_multipart(base_url() . 'users/update_user', $attributes);
            ?>
            <td><img src="<?php echo base_url() . "media/avatar/thumb/" . $user->avatarurl ?>" alt="<?php echo $user->name . " " . $user->surname ?> | Avatar" class="img-thumbnail avatar" /></td>
            <td><input class="form-control userName" value="<?php echo $user->user; ?>" name="user" type="text" readonly /></td>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->surname; ?></td>
            <td><?php echo $user->email; ?></td>            
            <td> 
                <select name="role" class="form-control">
                    <option <?php echo ($user->role == 1 ? 'selected' : '' )?> value="1">Normal</option>
                    <option <?php echo ($user->role == 0 ? 'selected' : '' )?> value="0">Administrator</option>
                </select>            
            </td>
            <td>
                <button class="btn btn-sm btn-success" type="submit">Update</button>
            </td>
            <td>
                <button class="btn btn-sm btn-danger onDeleteUser" data-toggle="modal" data-id="<?php echo $user->id; ?>" data-target="#modal">Delete</button>
            </td>
            </form>
        </tr>
    <?php } ?>          
      </tbody>
</table>
</div>