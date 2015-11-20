<div class="places form">
<?php echo $this->Form->create('Place'); ?>
    <fieldset>
        <legend><?php echo __('Add Place'); ?></legend>
	<?php
		echo $this->Form->input('title',array('label'=>'Nombre'));
		echo $this->Form->input('telefono');
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Lista de lugares'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('Dashboard'), array('controller'=>'dashboard','action' => 'index')); ?></li>
    </ul>
</div>
