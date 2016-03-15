<section class="login-background">
	<div class="login-overlay">
		<div class="login-container">
			<div class="logo">
				<img src="/assets/img/logo.png">
			</div>

			<h1 class="logo-text">Hetic</h1>
		
			<form method="POST" class="login-form">
				<div class="login-box">
					<?php $this->flash->display() ?>

					<label for="username">Identifiant</label>
				    <input type="text" name="username">
				    <label for="password">Mot de passe</label>
				    <input type="password" name="password">
				</div>

				<button>Connectez vous</button>
			</form>
		</div>
	</div>
</section>
