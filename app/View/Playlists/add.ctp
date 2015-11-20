<div class="playlists form">
<?php echo $this->Form->create('Playlist'); ?>
	<fieldset>
		<legend><?php echo __('Add Playlist'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('iframe');
		echo $this->Form->input('habilitado');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Playlists'), array('action' => 'index')); ?></li>
	</ul>
</div>
