<div class="socials view">
<h2><?php echo __('Social'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($social['Social']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($social['Event']['id'], array('controller' => 'events', 'action' => 'view', $social['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo'); ?></dt>
		<dd>
			<?php echo h($social['Social']['tipo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($social['Social']['value']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Social'), array('action' => 'edit', $social['Social']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Social'), array('action' => 'delete', $social['Social']['id']), null, __('Are you sure you want to delete # %s?', $social['Social']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Socials'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Social'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>
