<div class="eventsKitelements form">
<?php echo $this->Form->create('EventsKitelement'); ?>
	<fieldset>
		<legend><?php echo __('Edit Events Kitelement'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('event_id');
		echo $this->Form->input('kitelement_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('EventsKitelement.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('EventsKitelement.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Events Kitelements'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Kitelements'), array('controller' => 'kitelements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Kitelement'), array('controller' => 'kitelements', 'action' => 'add')); ?> </li>
	</ul>
</div>
