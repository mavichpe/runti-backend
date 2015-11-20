<div class="alerts form">
<?php echo $this->Form->create('Alert'); ?>
	<fieldset>
		<legend><?php echo __('Edit Alert'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('userid');
		echo $this->Form->input('date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Alert.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Alert.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Alerts'), array('action' => 'index')); ?></li>
	</ul>
</div>
