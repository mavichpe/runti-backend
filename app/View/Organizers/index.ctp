<div class="organizers index">
    <h2><?php echo __('Organizers'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('title'); ?></th>
            <th><?php echo $this->Paginator->sort('ced'); ?></th>
            <th><?php echo $this->Paginator->sort('logo'); ?></th>
            <th><?php echo $this->Paginator->sort('descripcion'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
	<?php foreach ($organizers as $organizer): ?>
        <tr>
            <td><?php echo h($organizer['Organizer']['id']); ?>&nbsp;</td>
            <td><?php echo h($organizer['Organizer']['title']); ?>&nbsp;</td>
            <td><?php echo h($organizer['Organizer']['ced']); ?>&nbsp;</td>
            <td><?php echo h($organizer['Organizer']['logo']); ?>&nbsp;</td>
            <td><?php echo h($organizer['Organizer']['descripcion']); ?>&nbsp;</td>
            <td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $organizer['Organizer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $organizer['Organizer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $organizer['Organizer']['id']), null, __('Are you sure you want to delete # %s?', $organizer['Organizer']['id'])); ?>
            </td>
        </tr>
<?php endforeach; ?>
    </table>
    <p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
    <div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Nuevo Organizador'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'dashboard', 'action' => 'index')); ?> </li>
    </ul>
</div>
