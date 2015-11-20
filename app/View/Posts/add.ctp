<div class="posts form">
<?php echo $this->Form->create('Post',array('type' => 'file','class'=>'form-editor')); ?>
    <fieldset>
        <legend><?php echo __('Add Post'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('text');
		echo $this->Form->input('categoria',array('options'=>array(1=>'Entrenamiento',2=>'Nutricion',3=>'Noticias')));
		echo $this->Form->input('sponsor_id',array('label'=>'Patrocinador'));
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?></li>
    </ul>
</div>

<script>
    $(function () {
        $('.form-editor').submit(function () {
            var texto = tinyMCE.get('PostText').getContent()
            $('#PostText').text(texto);
        });
    });
</script>