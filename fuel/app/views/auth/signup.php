<form action="<?php echo Uri::create('auth/signup'); ?>" method="post" class="">
    <?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
    <div class="form-group">
	<label for="username">username</label>
	<input class="form-control" name="username" type="text" value="" placeholder="username" />
    </div>
    <div class="form-group">
	<lavel for="password">password</label>
	<input class="form-control" name="password" type="password" value="" placeholder="password" />
    </div>
    <div class="form-group">
	<lavel for="email">email</label>
	<input class="form-control" name="email" type="email" value="" placeholder="email" />
    </div>
    <div class="form-group">
	<input class="btn btn-success" type="submit" value="登録"/>
    </div>
</form>
