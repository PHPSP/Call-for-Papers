<div class="reports separate-lists">
    <h2> <?php __("Proposals from "); echo $country; ?></h2>
    
    <dl>
        <dt> <?php __('Quantity') ?>: </dt>
        <dd> <?php echo $quant ?> </dd>
    </dl>
    
    <?php echo $this->element('proposal_list', array('proposals'=>$proposals)); ?>
</div>