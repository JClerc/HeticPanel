<?php $this->flash->display() ?>

Bonjour <?= $data['username'] ?>

<form method="POST">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="submit">
</form>
