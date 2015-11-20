<div class="kitdelivers index">
	<h2><?php echo __('Kitdelivers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('event_id'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha'); ?></th>
			<th><?php echo $this->Paginator->sort('place_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($kitdelivers as $kitdeliver): ?>
	<tr>
		<td><?php echo h($kitdeliver['Kitdeliver']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($kitdeliver['Event']['id'], array('controller' => 'events', 'action' => 'view', $kitdeliver['Event']['id'])); ?>
		</td>
		<td><?php echo h($kitdeliver['Kitdeliver']['fecha']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($kitdeliver['Place']['title'], array('controller' => 'places', 'action' => 'view', $kitdeliver['Place']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $kitdeliver['Kitdeliver']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $kitdeliver['Kitdeliver']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $kitdeliver['Kitdeliver']['id']), null, __('Are you sure you want to delete # %s?', $kitdeliver['Kitdeliver']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Kitdeliver'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Places'), array('controller' => 'places', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Place'), array('controller' => 'places', 'action' => 'add')); ?> </li>
	</ul>
</div>
