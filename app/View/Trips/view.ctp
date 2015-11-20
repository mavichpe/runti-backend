<div class="trips view">
    <h2><?php echo __('Rutas'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
			<?php echo h($trip['Trip']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Event'); ?></dt>
        <dd>
			<?php echo $this->Html->link($trip['Event']['id'], array('controller' => 'events', 'action' => 'view', $trip['Event']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Distance'); ?></dt>
        <dd>
			<?php echo h($trip['Trip']['distance']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Costo'); ?></dt>
        <dd>
			<?php echo h($trip['Trip']['costo']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Start'); ?></dt>
        <dd>
			<?php echo h($trip['Trip']['start']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('End'); ?></dt>
        <dd>
			<?php echo h($trip['Trip']['end']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Trip'), array('action' => 'edit', $trip['Trip']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Trip'), array('action' => 'delete', $trip['Trip']['id']), null, __('Are you sure you want to delete # %s?', $trip['Trip']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Trips'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Trip'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
    </ul>
</div>
