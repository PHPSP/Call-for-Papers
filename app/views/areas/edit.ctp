<div class="areas form">
<?php echo $this->Form->create('Area');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('Area', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Area.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Area.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Areas', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Proposals', true)), array('controller' => 'proposals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Proposal', true)), array('controller' => 'proposals', 'action' => 'add')); ?> </li>
	</ul>
</div>