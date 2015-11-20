<div class="kitelements form">
<?php echo $this->Form->create('Kitelement'); ?>
    <fieldset>
        <legend><?php echo __('Edit Kitelement'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title',array('label'=>'Nombre'));
		echo $this->Form->input('documento',array('label'=>'Archivo'));
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Lista de Elementos de kit'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('Dashboard'), array('controller'=>'dashboard','action' => 'index')); ?></li>
    </ul>
</div>
