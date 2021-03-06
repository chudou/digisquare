<div role="main">
	<div class="badges form">
		<h1><?php echo __('Add Badge'); ?></h1>
		<?php echo $this->Form->create('Badge', array(
			'inputDefaults' => array(
				'div' => 'form-group',
				'label' => array(
					'class' => 'col col-md-3 control-label'
				),
				'wrapInput' => 'col col-md-9',
				'class' => 'form-control'
			),
			'class' => 'well form-horizontal',
			'type' => 'file'
		)); ?>
			<?php
				echo $this->Form->input('name');
				$types = array('Event' => __('Event'), 'Startup' => __('Startup'), 'Place' => __('Place'),'Participant' => __('Participant'));
				echo $this->Form->input('type', array('options' => $types, 'default' => 'events'));
				echo $this->Form->input('minimum');
				echo $this->Form->input('description');
				echo $this->Form->input('icon');
				echo $this->Form->input('file', array('type' => 'file'));
			?>
			<div class="form-group">
				<div class="col col-md-9 col-md-offset-3">
					<?php echo $this->Form->submit('Save changes', array(
						'class' => 'btn btn-primary'
					)); ?>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>