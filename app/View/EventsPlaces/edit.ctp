<div class="eventsPlaces form">
<?php echo $this->Form->create('EventsPlace'); ?>
	<fieldset>
		<legend><?php echo __('Edit Events Place'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('place_id');
		echo $this->Form->input('event_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('EventsPlace.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('EventsPlace.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Events Places'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Places'), array('controller' => 'places', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Place'), array('controller' => 'places', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>
