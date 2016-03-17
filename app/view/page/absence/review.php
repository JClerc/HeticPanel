
Tu as été absent le <?= $data['date']->toString() ?> en cours de <?= $data['course']->get('name') ?>.

<form method="post" enctype="multipart/form-data">
    <textarea name="reason" id="" cols="30" rows="10">Raison</textarea>
    <input type="file" name="proof">
    <button type="submit">Valider</button>
</form>

