<div class="imageslikes view">
<h2><?php echo __('Imageslike'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($imageslike['Imageslike']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($imageslike['User']['id'], array('controller' => 'users', 'action' => 'view', $imageslike['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo $this->Html->link($imageslike['Image']['id'], array('controller' => 'images', 'action' => 'view', $imageslike['Image']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($imageslike['Imageslike']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Imageslike'), array('action' => 'edit', $imageslike['Imageslike']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Imageslike'), array('action' => 'delete', $imageslike['Imageslike']['id']), null, __('Are you sure you want to delete # %s?', $imageslike['Imageslike']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Imageslikes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Imageslike'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
	</ul>
</div>
