<?php if (isset($data['success']) && isset($data['message'])): ?>
    <div 
    	class="alert alert-<?php if ($data['success']): ?>success<?php else: ?>error<?php endif; ?>">
    	<?= $data['message']; ?>
   	</div>
<?php endif; ?>
