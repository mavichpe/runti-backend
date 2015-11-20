<div class="importers view">
<h2><?php echo __('Importer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($importer['Importer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Refeid'); ?></dt>
		<dd>
			<?php echo h($importer['Importer']['refeid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sku'); ?></dt>
		<dd>
			<?php echo h($importer['Importer']['sku']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($importer['Importer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($importer['Importer']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($importer['User']['id'], array('controller' => 'users', 'action' => 'view', $importer['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Importer'), array('action' => 'edit', $importer['Importer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Importer'), array('action' => 'delete', $importer['Importer']['id']), null, __('Are you sure you want to delete # %s?', $importer['Importer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Importers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Importer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
