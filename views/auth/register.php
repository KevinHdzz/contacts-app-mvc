<?php include_once __DIR__ . "/../partials/header.php" ?>

<div class="form-container">
	<form action="/register" method="post" class="form">
		<p class="text-center">Create Account</p>
		<div class="field">
			<label for="username">Username:</label>
			<div class="field-input">
				<input class="username" type="text" name="username" id="username" placeholder="Your username" value="<?= htmlspecialchars($values["username"] ?? "") ?>" autofocus>
				<p class="error-msg"><?= $errors["username"] ?? "" ?></p>
			</div>
		</div>
		<div class="field">
			<label for="email">Email:</label>
			<div class="field-input">
				<input class="email" type="email" name="email" id="email" placeholder="Your email address" value="<?= htmlspecialchars($values["email"] ?? "") ?>">
				<p class="error-msg"><?= $errors["email"] ?? "" ?></p>
			</div>
		</div>
		<div class="field">
			<label for="password">Password:</label>
			<div class="field-input">
				<input class="password" type="password" name="password" id="password" placeholder="Your password (at least 6 characteres)">
				<p class="error-msg"><?= $errors["password"] ?? "" ?></p>
			</div>
		</div>
		<div class="submit">
			<p class="register">You are registered?
				<a href="/login">Log in</a>
			</p>
			<input class="btn submit-btn" type="submit" value="Create account">
		</div>
	</form>
</div>

<?php include __DIR__ . "/../partials/footer.php" ?>
