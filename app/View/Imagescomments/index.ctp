<div class="imagescomments index">
	<h2><?php echo __('Imagescomments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('image_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($imagescomments as $imagescomment): ?>
	<tr>
		<td><?php echo h($imagescomment['Imagescomment']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($imagescomment['Image']['id'], array('controller' => 'images', 'action' => 'view', $imagescomment['Image']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($imagescomment['User']['id'], array('controller' => 'users', 'action' => 'view', $imagescomment['User']['id'])); ?>
		</td>
		<td><?php echo h($imagescomment['Imagescomment']['comment']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $imagescomment['Imagescomment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $imagescomment['Imagescomment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $imagescomment['Imagescomment']['id']), null, __('Are you sure you want to delete # %s?', $imagescomment['Imagescomment']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Imagescomment'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
