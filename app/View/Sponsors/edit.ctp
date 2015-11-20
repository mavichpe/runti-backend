<div class="sponsors form">
<?php echo $this->Form->create('Sponsor',array('type' => 'file')); ?>
    <fieldset>
        <legend><?php echo __('Edit Sponsor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('Horario');
		echo $this->Form->input('telefono');
		echo $this->Form->input('url');
		echo $this->Form->input('facebook');
                  if (isset($this->request->data['Sponsor']['logo']) and $this->request->data['Sponsor']['logo'] != '')
                        echo $this->Html->image($this->request->data['Post']['img'],array('style'=>'width:200px;height:auto'));
		echo $this->Form->input('logo', array('type'=>'file'));
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Sponsor.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Sponsor.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Sponsors'), array('action' => 'index')); ?></li>
    </ul>
</div>
