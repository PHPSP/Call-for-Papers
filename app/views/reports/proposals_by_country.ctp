<div class="reports separate-lists">
    <h2> <?php __("Proposals from "); echo $country; ?></h2>
    
    <dl>
        <dt> <?php __('Quantity') ?>: </dt>
        <dd> <?php echo $quant ?> </dd>
    </dl>
    
    <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('area_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('level');?></th>
			<th><?php echo $this->Paginator->sort('time');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($proposals as $proposal):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $proposal['Proposal']['id']; ?> </td>
		<td><?php echo $proposal['Area']['name']; ?> </td>
		<td><?php echo $this->Html->link($proposal['Proposal']['title'], array('controller'=>'proposals','action'=>'view','id'=>$proposal['Proposal']['id'])); ?>&nbsp;</td>
		<td><?php echo $proposal['Level']['name']; ?>&nbsp;</td>
		<td><?php echo $proposal['Proposal']['time']; ?>min</td>
	</tr>
<?php endforeach; ?>
	</table>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>