<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('User', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		//echo $this->Form->input('fbid');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>