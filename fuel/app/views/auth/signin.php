<form action="<?php echo Uri::create('auth/signin'); ?>" method="post" class="">
    <?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>

    <div class="form-group">
	<label for="username">username</label>
	<input class="form-control" name="username" type="text" value="" placeholder="username"/>
    </div>

    <div class="form-group">
	<label for="password">password</label>
	<input class="form-control" name="password" type="password" value="" placeholder="password"/>
    </div>

    <div class="form-group">
	<input class="btn btn-success" name="" type="submit" value="サインイン"/>
    </div>
    
</form>
