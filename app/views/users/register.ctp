<div class="users register">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php printf(__('Register a new %s', true), __('User', true)); ?></legend>
	<?php
		echo $this->Form->input('email', 
								array('after' => $form->error(
		                        	  'email_unique', 'This email is already registered.')));
		echo $this->Form->input('password');
		echo $this->Form->input('password2',array('type'=>'password', 'label'=>__('Confirm your password',true)));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>