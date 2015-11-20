<div class="postslikes view">
<h2><?php echo __('Postslike'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($postslike['Postslike']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($postslike['User']['id'], array('controller' => 'users', 'action' => 'view', $postslike['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post'); ?></dt>
		<dd>
			<?php echo $this->Html->link($postslike['Post']['title'], array('controller' => 'posts', 'action' => 'view', $postslike['Post']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($postslike['Postslike']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Postslike'), array('action' => 'edit', $postslike['Postslike']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Postslike'), array('action' => 'delete', $postslike['Postslike']['id']), null, __('Are you sure you want to delete # %s?', $postslike['Postslike']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Postslikes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Postslike'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
