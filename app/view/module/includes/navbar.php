<header class="navbar">
	<div class="container">
		<img src="/assets/img/logo.png" class="logo">

		<div class="nav-right">
			<a href="/auth/logout" class="logout">Déconnexion</a>
			<div class="avatar"></div>
			<div class="infos">
				<?= $data['user']->get('firstname'); ?> <?= strtoupper($data['user']->get('lastname')); ?>
				<a href="/auth/settings">éditer mon profil</a>
		</div>
	</div>
</header>