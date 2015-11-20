<div class="alerts view">
<h2><?php echo __('Alert'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($alert['Alert']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Userid'); ?></dt>
		<dd>
			<?php echo h($alert['Alert']['userid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($alert['Alert']['date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Alert'), array('action' => 'edit', $alert['Alert']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Alert'), array('action' => 'delete', $alert['Alert']['id']), null, __('Are you sure you want to delete # %s?', $alert['Alert']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Alerts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Alert'), array('action' => 'add')); ?> </li>
	</ul>
</div>
