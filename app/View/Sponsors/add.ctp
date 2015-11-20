<div class="sponsors form">
<?php echo $this->Form->create('Sponsor'); ?>
    <fieldset>
        <legend><?php echo __('Add Sponsor'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('Horario');
		echo $this->Form->input('telefono');
		echo $this->Form->input('url');
		echo $this->Form->input('facebook');
		//echo $this->Form->input('logo');
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Sponsors'), array('action' => 'index')); ?></li>
    </ul>
</div>
