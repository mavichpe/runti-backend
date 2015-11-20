<div class="trips form">
<?php echo $this->Form->create('Trip'); ?>
    <fieldset>
        <legend><?php echo __('Agregar Ruta'); ?></legend>
	<?php
		echo $this->Form->input('event_id');
		echo $this->Form->input('distance');
		echo $this->Form->input('costo');
		echo $this->Form->input('start');
		echo $this->Form->input('end');
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Trips'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
    </ul>
</div>
