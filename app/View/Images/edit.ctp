<div class="images form">
<?php echo $this->Form->create('Image'); ?>
    <fieldset>
        <legend><?php echo __('Edit Image'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
                if (isset($this->request->data['Image']['url']) and $this->request->data['Image']['url'] != '')
                    echo $this->Html->image($this->request->data['Image']['url'], array('style' => 'width:200px;height:auto'));
                echo $this->Form->input('url',array('type'=>'file'));
		echo $this->Form->input('album_id');
                ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Image.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Image.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Images'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Imagescomments'), array('controller' => 'imagescomments', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Imagescomment'), array('controller' => 'imagescomments', 'action' => 'add')); ?> </li>
    </ul>
</div>
