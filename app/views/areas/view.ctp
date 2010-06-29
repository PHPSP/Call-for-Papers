<div class="areas view">
<h2><?php  __('Area');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $area['Area']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $area['Area']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('Area', true)), array('action' => 'edit', $area['Area']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('Area', true)), array('action' => 'delete', $area['Area']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $area['Area']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Areas', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Area', true)), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Proposals', true)), array('controller' => 'proposals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Proposal', true)), array('controller' => 'proposals', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php printf(__('Related %s', true), __('Proposals', true));?></h3>
	<?php if (!empty($area['Proposal'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Speaker Id'); ?></th>
		<th><?php __('Area Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Abstract'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('After'); ?></th>
		<th><?php __('Level'); ?></th>
		<th><?php __('Time'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($area['Proposal'] as $proposal):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $proposal['id'];?></td>
			<td><?php echo $proposal['speaker_id'];?></td>
			<td><?php echo $proposal['area_id'];?></td>
			<td><?php echo $proposal['title'];?></td>
			<td><?php echo $proposal['abstract'];?></td>
			<td><?php echo $proposal['description'];?></td>
			<td><?php echo $proposal['after'];?></td>
			<td><?php echo $proposal['level'];?></td>
			<td><?php echo $proposal['time'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'proposals', 'action' => 'view', $proposal['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'proposals', 'action' => 'edit', $proposal['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'proposals', 'action' => 'delete', $proposal['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $proposal['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Proposal', true)), array('controller' => 'proposals', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
