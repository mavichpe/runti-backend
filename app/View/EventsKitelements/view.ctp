<div class="eventsKitelements view">
<h2><?php echo __('Events Kitelement'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($eventsKitelement['EventsKitelement']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($eventsKitelement['Event']['id'], array('controller' => 'events', 'action' => 'view', $eventsKitelement['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kitelement'); ?></dt>
		<dd>
			<?php echo $this->Html->link($eventsKitelement['Kitelement']['title'], array('controller' => 'kitelements', 'action' => 'view', $eventsKitelement['Kitelement']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Events Kitelement'), array('action' => 'edit', $eventsKitelement['EventsKitelement']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Events Kitelement'), array('action' => 'delete', $eventsKitelement['EventsKitelement']['id']), null, __('Are you sure you want to delete # %s?', $eventsKitelement['EventsKitelement']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Events Kitelements'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Events Kitelement'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Kitelements'), array('controller' => 'kitelements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Kitelement'), array('controller' => 'kitelements', 'action' => 'add')); ?> </li>
	</ul>
</div>
