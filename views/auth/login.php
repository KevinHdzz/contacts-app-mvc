<?php include_once __DIR__ . "/../partials/header.php" ?>

<div class="form-container">
	<form action="/login" method="POST" class="form">
		<p class="text-center">Log in</p>
		<?php if (isset($errors) && !is_assoc($errors)) : ?>
			<div class="head-errors">
				<?php foreach ($errors as $error) : ?>
					<p class="error-msg"><?= $error ?></p>
				<?php endforeach ?>
			</div>
		<?php endif ?>
		<div class="field">
			<label for="email">Email:</label>
			<div class="field-input">
				<input class="email" type="email" name="email" id="email" placeholder="Your email address" value="<?= htmlspecialchars($values["email"] ?? "") ?>" autofocus>
				<p class="error-msg"><?= $errors["email"] ?? "" ?></p>
			</div>
		</div>
		<div class="field">
			<label for="password">Password:</label>
			<div class="field-input">
				<input class="password" type="password" name="password" id="password" placeholder="Your password">
				<p class="error-msg"><?= $errors["password"] ?? "" ?></p>
			</div>
		</div>
		<div class="submit">
			<p class="register">You are not registered?
				<a href="/register">Create account</a>
			</p>
			<input class="btn submit-btn" type="submit" value="Log in">
		</div>
	</form>
</div>

<?php include __DIR__ . "/../partials/footer.php" ?>
