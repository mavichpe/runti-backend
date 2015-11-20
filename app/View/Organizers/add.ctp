<div class="organizers form">
<?php echo $this->Form->create('Organizer'); ?>
	<fieldset>
		<legend><?php echo __('Add Organizer'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('ced');
		echo $this->Form->input('logo');
		echo $this->Form->input('descripcion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Organizers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>
