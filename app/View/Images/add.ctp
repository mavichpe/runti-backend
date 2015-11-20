<div class="images form">
<?php echo $this->Form->create('Image',array('type'=>'file')); ?>
    <fieldset>
        <legend><?php echo __('Add Image'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('url',array('type'=>'file'));
		echo $this->Form->input('album_id');
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Images'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Imagescomments'), array('controller' => 'imagescomments', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Imagescomment'), array('controller' => 'imagescomments', 'action' => 'add')); ?> </li>
    </ul>
</div>
