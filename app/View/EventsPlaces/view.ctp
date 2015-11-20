<div class="eventsPlaces view">
<h2><?php echo __('Events Place'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($eventsPlace['EventsPlace']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Place'); ?></dt>
		<dd>
			<?php echo $this->Html->link($eventsPlace['Place']['title'], array('controller' => 'places', 'action' => 'view', $eventsPlace['Place']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($eventsPlace['Event']['id'], array('controller' => 'events', 'action' => 'view', $eventsPlace['Event']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Events Place'), array('action' => 'edit', $eventsPlace['EventsPlace']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Events Place'), array('action' => 'delete', $eventsPlace['EventsPlace']['id']), null, __('Are you sure you want to delete # %s?', $eventsPlace['EventsPlace']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Events Places'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Events Place'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Places'), array('controller' => 'places', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Place'), array('controller' => 'places', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>
