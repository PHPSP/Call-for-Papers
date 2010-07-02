<div class="proposals form">
<?php echo $this->Form->create('Proposal');?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Proposal', true)); ?></legend>
	<?php
		echo $this->Form->hidden('speaker_id');
		echo $this->Form->input('area_id');
		echo $this->Form->input('title');
		echo $this->Form->input('abstract');
		echo $this->Form->input('description');
		echo $this->Form->input('after', array('label'=>__('After the speech, what attendee will know?', true)));
		echo $this->Form->input('level_id');
		echo $this->Form->input('time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>