<p style="color:red">
	<?php (isset($error)) ? print $error : print ''; ?>
</p>
		<div class="new_user_parent" style="z-index: 2000;width:50%">
			<h2>Sign in</h2>

			<form accept-charset="UTF-8" action="<?php echo $root ?>/sign_up" onsubmit="return validateForm()" class="form-group new_user new_user_devise" id="new_user" method="post">
				<div class="form-group col-lg-4">
					<label for="name">Email</label>
					<br>
					<input class="form-control" autofocus="autofocus" id="name" name="name" value="" type="email">
				</div>

				<div class="form-group col-lg-1">
					<label for="password">Password</label>
					<br>
					<input class="form-control" id="password" name="password" type="password">
				</div>
				
				<div class="form-group col-lg-1">
					<label for="password">Confirmation</label>
					<br>
					<input class="form-control" id="confirmation" name="confirmation" type="password">
				</div>

				<div class="form-group col-lg-1">
					<input class="form-control" type='submit' name='Submit' value='Submit' />
				</div>
			</form>

			<a href="<?php echo $root ?>/sign_in">Sign In</a>
			<br>
		</div>
</form>
