<div class="sponsors view">
<h2><?php echo __('Sponsor'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Horario'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['Horario']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefono'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['telefono']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Facebook'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['facebook']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logo'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['logo']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sponsor'), array('action' => 'edit', $sponsor['Sponsor']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sponsor'), array('action' => 'delete', $sponsor['Sponsor']['id']), null, __('Are you sure you want to delete # %s?', $sponsor['Sponsor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sponsors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sponsor'), array('action' => 'add')); ?> </li>
	</ul>
</div>
