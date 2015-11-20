<div class="importers form">
<?php echo $this->Form->create('Importer'); ?>
	<fieldset>
		<legend><?php echo __('Edit Importer'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('refeid');
		echo $this->Form->input('sku');
		echo $this->Form->input('amount');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Importer.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Importer.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Importers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
