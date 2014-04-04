<div class="events24h view">

	<div class="page-header">
		<h2><?php echo __('events less 24h'); ?></h2>
	</div>
		
	<table class="table table-bordered table-striped">
	<tr>
		<th><?php echo $this->Paginator->sort('Id'); ?></th>
		<th><?php echo $this->Paginator->sort('Edition_id'); ?></th>
		<th><?php echo $this->Paginator->sort('place_id'); ?></th>
		<th><?php echo $this->Paginator->sort('Name'); ?></th>
		<th><?php echo $this->Paginator->sort('Description'); ?></th>	
		<th><?php echo $this->Paginator->sort('Start_at'); ?></th>	
		<th><?php echo $this->Paginator->sort('End_at'); ?></th>
		<th><?php echo $this->Paginator->sort('Status'); ?></th>
		<th><?php echo $this->Paginator->sort('Url'); ?></th>
		<th><?php echo $this->Paginator->sort('Created'); ?></th>
		<th><?php echo $this->Paginator->sort('Modified'); ?></th>
	</tr>
	<?php foreach ($events24h as $event): ?>
		<tr>
			<td><?php echo h($event['Event']['id']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link(
					$event['Place']['name'],
					array('controller' => 'places', 'action' => 'view', 'id' => $event['Place']['id'])
				); ?>
			</td>
			<td>
				<?php echo $this->Html->link(
					$event['Edition']['name'],
					array('controller' => 'editions', 'action' => 'view', 'id' => $event['Edition']['id'])
				); ?>
			</td>
			<td><?php echo h($event['Event']['name']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['description']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['start_at']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['end_at']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['status']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['url']); ?>&nbsp;</td>	
			<td><?php echo h($event['Event']['created']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['modified']); ?>&nbsp;</td>
			
		</tr>
		<?php endforeach; ?>
	</table>	
	<?php echo $this->Paginator->pagination(
		array('ul' => 'pagination')
	); ?>
</div>