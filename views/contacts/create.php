<?php include __DIR__ . "/../partials/header.php" ?>

<div class="form-container">
	<form action="/contacts/create" method="post" class="form">
		<p class="text-center">Create Contact</p>
		<div class="field">
			<label for="name">Name:</label>
			<div class="field-input">
				<input
					type="text"
					name="name"
					id="name"
					placeholder="Contact name"
					value="<?= htmlspecialchars($contact["name"] ?? "") ?>" autofocus
				>
				<p class="error-msg"><?= $errors["name"] ?? "" ?></p>
			</div>
		</div>
		<div class="field">
			<label for="phone">Phone:</label>
			<div class="field-input">
				<input
					type="tel"
					name="phone"
					id="phone"
					placeholder="Contact phone"
					value="<?= isset($contact["phone"]) ? htmlspecialchars(format_phone_number($contact["phone"])) : "" ?>"
				>
				<p class="error-msg"><?= $errors["phone"] ?? "" ?></p>
			</div>
		</div>
		<div class="field">
			<label for="email">Email:</label>
			<div class="field-input">
				<input
					name="email"
					id="email"
					placeholder="Contact email (Optional)"
					value="<?= htmlspecialchars($contact["email"] ?? "") ?>"
				>
				<p class="error-msg"><?= $errors["email"] ?? "" ?></p>
			</div>
		</div>
		<div class="flex justify-end pt-1">
			<input class="btn submit-btn" type="submit" value="Create Contact">
		</div>
	</form>
</div>

<?php include __DIR__ . "/../partials/footer.php" ?>
