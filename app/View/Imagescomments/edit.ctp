<div class="imagescomments form">
<?php echo $this->Form->create('Imagescomment'); ?>
	<fieldset>
		<legend><?php echo __('Edit Imagescomment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('image_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Imagescomment.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Imagescomment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Imagescomments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
