<div class="organizers view">
<h2><?php echo __('Organizer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($organizer['Organizer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($organizer['Organizer']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ced'); ?></dt>
		<dd>
			<?php echo h($organizer['Organizer']['ced']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logo'); ?></dt>
		<dd>
			<?php echo h($organizer['Organizer']['logo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descripcion'); ?></dt>
		<dd>
			<?php echo h($organizer['Organizer']['descripcion']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Organizer'), array('action' => 'edit', $organizer['Organizer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Organizer'), array('action' => 'delete', $organizer['Organizer']['id']), null, __('Are you sure you want to delete # %s?', $organizer['Organizer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Events'); ?></h3>
	<?php if (!empty($organizer['Event'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Fecha'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Organizer Id'); ?></th>
		<th><?php echo __('Fecha Inscripcion'); ?></th>
		<th><?php echo __('Precio Inscripcion'); ?></th>
		<th><?php echo __('Camiseta'); ?></th>
		<th><?php echo __('Lugar'); ?></th>
		<th><?php echo __('Geolocation'); ?></th>
		<th><?php echo __('Trip'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Logo'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organizer['Event'] as $event): ?>
		<tr>
			<td><?php echo $event['id']; ?></td>
			<td><?php echo $event['nombre']; ?></td>
			<td><?php echo $event['fecha']; ?></td>
			<td><?php echo $event['created']; ?></td>
			<td><?php echo $event['modified']; ?></td>
			<td><?php echo $event['organizer_id']; ?></td>
			<td><?php echo $event['fecha_inscripcion']; ?></td>
			<td><?php echo $event['precio_inscripcion']; ?></td>
			<td><?php echo $event['camiseta']; ?></td>
			<td><?php echo $event['lugar']; ?></td>
			<td><?php echo $event['geolocation']; ?></td>
			<td><?php echo $event['trip']; ?></td>
			<td><?php echo $event['description']; ?></td>
			<td><?php echo $event['logo']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'events', 'action' => 'view', $event['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'events', 'action' => 'edit', $event['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'events', 'action' => 'delete', $event['id']), null, __('Are you sure you want to delete # %s?', $event['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
