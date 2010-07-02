<div class="speakers form">
<?php echo $this->Form->create('Speaker', array('enctype' => 'multipart/form-data'));?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('Speaker', true)); ?></legend>
 		<p>
     	  <?php __('We need to know some little information from you before you can submit any proposal. You can change this information later, but you cannot skip this step.'); ?>
     	</p>
 	    <p>&nbsp;</p>
	<?php
	    if ( ! empty($this->data['Speaker']['image']['thumb']) ) {
	        echo $this->Html->image($this->data['Speaker']['image']['thumb']);
        }
		echo $this->Form->input('id');
		echo $this->Form->hidden('user_id');
		echo $this->Form->input('image', array('label'=>__('Avatar',true), 'type'=>'file'));
                echo $this->Form->input('firstName',array('label'=>__('First Name',true)));
                echo $this->Form->input('lastName',array('label'=>__('Last Name',true)));
		echo $this->Form->input('rg');
		echo $this->Form->input('abstract', array('label'=>__('Bio',true)));
		echo $this->Form->input('description', array('label'=>__('Full Bio',true)));
		echo $this->Form->input('phone');
		echo $this->Form->input('zip');
		echo $this->Form->input('country');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('address');
		echo $this->Form->input('complement');
		echo $this->Form->input('twitter');
		echo $this->Form->input('site');
		echo $this->Form->input('size_id', array('label'=>__('T-shirt size',true)));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>