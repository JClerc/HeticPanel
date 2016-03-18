<header class="navbar">
	<div class="container">
		<a href="/" class="logo-box"><div class="logo"></div></a>

		<a href="/" class="logo-text">Hetic</a>

		<div class="nav-right">
			<a href="/auth/logout/" class="logout">Déconnexion</a>
			<div class="avatar"></div>
			<div class="infos">
				<?= $data['user']->get('firstname'); ?> <?= strtoupper($data['user']->get('lastname')); ?>
				<a href="/auth/settings/">éditer mon profil</a>
			</div>
		</div>
	</div>
</header>
