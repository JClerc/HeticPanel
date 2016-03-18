<section class="login-background">
	<div class="login-overlay">
		<div class="login-container">

			<a href="/" class="logo-box">
				<div class="logo"></div>
			</a>

			<h1><a href="/" class="logo-text">Hetic</a></h1>
		
			<form method="POST" class="login-form">
				<div class="login-box">
					<?php $data['flash']->display() ?>

					<label for="username">Identifiant</label>
				    <input type="text" name="username" placeholder="Entrez votre identifiant">
				    <label for="password">Mot de passe</label>
				    <input type="password" name="password" placeholder="Entrez votre mot de passe">
				</div>

				<button>Connectez vous</button>
			</form>
		</div>
	</div>
</section>
