<div class="reports separate-lists">
    <h2> <?php __("Speakers from "); echo $country; ?></h2>
    
    <dl>
        <dt> <?php __('Quantity') ?>: </dt>
        <dd> <?php echo $quant ?> </dd>
    </dl>

    <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php __('Full Name'); ?></th>
			<th><?php echo $this->Paginator->sort('twitter');?></th>
			<th><?php echo $this->Paginator->sort('country');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('city');?></th>
			<th><?php __('Proposals') ; ?></th>
	</tr>
	<?php
	$i = 0;

	foreach ($speakers as $speaker):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $this->Html->link($speaker['Speaker']['id'], array('controller'=>'speakers', 'action'=>'view', 'speaker_id'=> $speaker['Speaker']['id'])); ?> </td>
		<td><?php echo$speaker['Speaker']['firstName'],' ',$speaker['Speaker']['lastName']; ?></td>
		<td><?php echo $speaker['Speaker']['twitter']; ?>&nbsp; </td>
		<td><?php echo $speaker['Speaker']['country']; ?>&nbsp;</td>
		<td><?php echo $speaker['Speaker']['state']; ?>&nbsp;</td>
		<td><?php echo $speaker['Speaker']['city']; ?>&nbsp;</td>
        <td><?php echo count($speaker['Proposal']); ?>&nbsp;</td>
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