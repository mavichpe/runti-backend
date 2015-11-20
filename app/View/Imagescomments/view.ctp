<div class="imagescomments view">
<h2><?php echo __('Imagescomment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($imagescomment['Imagescomment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo $this->Html->link($imagescomment['Image']['id'], array('controller' => 'images', 'action' => 'view', $imagescomment['Image']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($imagescomment['User']['id'], array('controller' => 'users', 'action' => 'view', $imagescomment['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($imagescomment['Imagescomment']['comment']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Imagescomment'), array('action' => 'edit', $imagescomment['Imagescomment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Imagescomment'), array('action' => 'delete', $imagescomment['Imagescomment']['id']), null, __('Are you sure you want to delete # %s?', $imagescomment['Imagescomment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Imagescomments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Imagescomment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
