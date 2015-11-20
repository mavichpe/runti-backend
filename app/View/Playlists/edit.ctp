<div class="playlists form">
<?php echo $this->Form->create('Playlist'); ?>
	<fieldset>
		<legend><?php echo __('Edit Playlist'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Playlist.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Playlist.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Playlists'), array('action' => 'index')); ?></li>
	</ul>
</div>
