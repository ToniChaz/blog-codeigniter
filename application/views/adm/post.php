<?php
if (isset($alertMessage)) {
    ?>
    <div class="alert <?php echo $class; ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $alert_message; ?>
    </div>
    <?php
}
if (!empty($all_posts)) {
    ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-posts">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_posts as $post_item) { ?>
                    <tr>        
                        <?php
                        $attributes = array('role' => 'form', 'id' => 'form' . $post_item['id']);
                        echo form_open_multipart(base_url() . 'post/edit_post', $attributes);
                        ?>
                        <td><p><?php echo $post_item['title'] ?></p></td>
                        <td><p><?php echo $post_item['date'] ?></p></td>
                        <td><p><?php echo $post_item['author'] ?></p></td>
                        <td><p><?php echo ($post_item['status'] == '1' ? 'Publish' : 'Not publish' ) ?></p></td>
                        <td><a href="<?php echo base_url() . 'post/edit/' . $post_item['id'] ?>" class="btn btn-sm btn-success">Edit</a></td>
                        <td><button class="btn btn-sm btn-danger onDeletePost" data-id="<?php echo $post_item['id'] ?>" data-toggle="modal" data-target="#modal">Delete</button></td>
                        </form>
                    </tr>
                <?php } ?>          
            </tbody>
        </table>
    </div>
    <?php
} else if (!empty($single_post)) {
    $attributes = array('role' => 'form');
    echo form_open_multipart(base_url() . 'post/update_post', $attributes);
    ?>
<input type="hidden" name="id" value="<?php echo $single_post->id ?>">
    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $single_post->title ?>">
            </div>
            <div class="form-group">
                <label for="slug">Url</label>
                <input id="slug" type="text" class="form-control" name="slug" placeholder="Url" value="<?php echo $single_post->slug ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="postDescription" class="form-control" name="description" maxlength="170" value="<?php echo $single_post->description ?>">
                <p class="help-block">You get <span id="charsLeft">170</span> characters to write.</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <div class="form-group">
                     <label for="author">Author</label>
                    <input type="text" readonly class="form-control" value="<?php echo $single_post->author ?>">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" class="form-control" value="<?php echo $single_post->date ?>">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <select name="price" class="form-control">
                        <option <?php echo ($single_post->price == 'low' ? 'selected' : '' ) ?> value="low">Low</option>
                        <option <?php echo ($single_post->price == 'medium' ? 'selected' : '' ) ?> value="medium">Medium</option>
                        <option <?php echo ($single_post->price == 'high' ? 'selected' : '' ) ?> value="high">High</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <textarea name="text" class="mceEditor" aria-hidden="true"><?php echo $single_post->text ?></textarea>
    </div>
    <div class="form-group">
        <div class="checkbox">
            <label>
                <input name="status"<?php echo ($single_post->status == 1 ? 'checked' : '' ) ?> type="checkbox"> Publish
            </label>
        </div>
        <button type="submit" class="btn btn-lg btn-success">Update</button>
    </div>
    </form>
    <?php
} else if (!empty($create_post)) {
    $attributes = array('role' => 'form');
    echo form_open_multipart(base_url() . 'post/create_post', $attributes);
    ?>
    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" type="text" class="form-control" name="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="slug">Url</label>
                <input id="slug" type="text" class="form-control" name="slug" placeholder="Url">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="postDescription" class="form-control" name="description" maxlength="170">
                <p class="help-block">You get <span id="charsLeft">170</span> characters to write.</p>
            </div> 
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" readonly class="form-control" value="<?php echo $create_post ?>">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <select name="price" class="form-control">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <textarea name="text" class="mceEditor" aria-hidden="true"></textarea>
    </div>
    <div class="form-group">
        <div class="checkbox">
            <label>
                <input name="status" type="checkbox"> Publish
            </label>
        </div>
        <button type="submit" class="btn btn-lg btn-primary">Create</button>
    </div>
    </form>
<?php } else if (!empty ($active_name_user)){ ?>
    <div class="jumbotron">
        <h2>Hello, <?php echo $active_name_user ?>!</h2>
        <p>Currently do not have any post, you dare to write one?</p>
        <p><a class="btn btn-primary" href="<?php echo base_url(); ?>create" role="button">Create post »</a></p>
    </div>
<?php } ?>
