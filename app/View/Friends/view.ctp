<div class="friends view">
<h2><?php echo __('Friend'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($friend['Friend']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($friend['User']['id'], array('controller' => 'users', 'action' => 'view', $friend['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Friend'); ?></dt>
		<dd>
			<?php echo $this->Html->link($friend['Friend']['id'], array('controller' => 'friends', 'action' => 'view', $friend['Friend']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Friend'), array('action' => 'edit', $friend['Friend']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Friend'), array('action' => 'delete', $friend['Friend']['id']), null, __('Are you sure you want to delete # %s?', $friend['Friend']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Friends'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Friend'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Friends'), array('controller' => 'friends', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Friend'), array('controller' => 'friends', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Friends'); ?></h3>
	<?php if (!empty($friend['Friend'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Friend Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($friend['Friend'] as $friend): ?>
		<tr>
			<td><?php echo $friend['id']; ?></td>
			<td><?php echo $friend['user_id']; ?></td>
			<td><?php echo $friend['friend_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'friends', 'action' => 'view', $friend['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'friends', 'action' => 'edit', $friend['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'friends', 'action' => 'delete', $friend['id']), null, __('Are you sure you want to delete # %s?', $friend['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Friend'), array('controller' => 'friends', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
