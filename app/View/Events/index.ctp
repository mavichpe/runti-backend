<div class="events index">
    <h2><?php echo __('Events'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('fecha'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('modified'); ?></th>
            <th><?php echo $this->Paginator->sort('organizer_id'); ?></th>
            <th><?php echo $this->Paginator->sort('fecha_inscripcion'); ?></th>
            <th><?php echo $this->Paginator->sort('kit-delivery'); ?></th>
            <th><?php echo $this->Paginator->sort('description'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
	<?php foreach ($events as $event): ?>
        <tr>
            <td><?php echo h($event['Event']['id']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['nombre']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['fecha']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['created']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['modified']); ?>&nbsp;</td>
            <td>
			<?php echo $this->Html->link($event['Organizer']['title'], array('controller' => 'organizers', 'action' => 'view', $event['Organizer']['id'])); ?>
            </td>
            <td><?php echo h($event['Event']['fecha_inscripcion']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['kit-delivery']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['description']); ?>&nbsp;</td>
            <td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $event['Event']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $event['Event']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $event['Event']['id']), null, __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?>
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
        <li><?php echo $this->Html->link(__('Nuevo Evento'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Dashboard'), array('controller'=>'dashboard','action' => 'index')); ?></li>
    </ul>
</div>
