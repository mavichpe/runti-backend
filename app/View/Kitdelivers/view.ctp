<div class="kitdelivers view">
<h2><?php echo __('Kitdeliver'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($kitdeliver['Kitdeliver']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($kitdeliver['Event']['id'], array('controller' => 'events', 'action' => 'view', $kitdeliver['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha'); ?></dt>
		<dd>
			<?php echo h($kitdeliver['Kitdeliver']['fecha']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Place'); ?></dt>
		<dd>
			<?php echo $this->Html->link($kitdeliver['Place']['title'], array('controller' => 'places', 'action' => 'view', $kitdeliver['Place']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Kitdeliver'), array('action' => 'edit', $kitdeliver['Kitdeliver']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Kitdeliver'), array('action' => 'delete', $kitdeliver['Kitdeliver']['id']), null, __('Are you sure you want to delete # %s?', $kitdeliver['Kitdeliver']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Kitdelivers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Kitdeliver'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Places'), array('controller' => 'places', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Place'), array('controller' => 'places', 'action' => 'add')); ?> </li>
	</ul>
</div>
