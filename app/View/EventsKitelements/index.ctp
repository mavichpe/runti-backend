<div class="eventsKitelements index">
	<h2><?php echo __('Events Kitelements'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('event_id'); ?></th>
			<th><?php echo $this->Paginator->sort('kitelement_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($eventsKitelements as $eventsKitelement): ?>
	<tr>
		<td><?php echo h($eventsKitelement['EventsKitelement']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($eventsKitelement['Event']['id'], array('controller' => 'events', 'action' => 'view', $eventsKitelement['Event']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($eventsKitelement['Kitelement']['title'], array('controller' => 'kitelements', 'action' => 'view', $eventsKitelement['Kitelement']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $eventsKitelement['EventsKitelement']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $eventsKitelement['EventsKitelement']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $eventsKitelement['EventsKitelement']['id']), null, __('Are you sure you want to delete # %s?', $eventsKitelement['EventsKitelement']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Events Kitelement'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Kitelements'), array('controller' => 'kitelements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Kitelement'), array('controller' => 'kitelements', 'action' => 'add')); ?> </li>
	</ul>
</div>
