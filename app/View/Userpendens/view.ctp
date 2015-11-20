<div class="userpendens view">
<h2><?php echo __('Userpenden'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userpenden['Userpenden']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reference'); ?></dt>
		<dd>
			<?php echo h($userpenden['Userpenden']['reference']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userpenden['User']['id'], array('controller' => 'users', 'action' => 'view', $userpenden['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kind'); ?></dt>
		<dd>
			<?php echo h($userpenden['Userpenden']['kind']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Userpenden'), array('action' => 'edit', $userpenden['Userpenden']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Userpenden'), array('action' => 'delete', $userpenden['Userpenden']['id']), null, __('Are you sure you want to delete # %s?', $userpenden['Userpenden']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Userpendens'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userpenden'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
