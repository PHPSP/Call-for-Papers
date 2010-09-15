<style>
    /*dl {
            margin-bottom: 20px;
            border-top: 3px solid #DDDDDD;
        }
        dt {
            display: block;
        }
        dd {
            display: block;
            margin: 0;
            margin-left: 200px;
            font-size: 2em;
            color: #BBBBBB;
        }*/
</style>
<div class="reports separate-lists">
    <h2> <?php __("Summary"); ?> </h2>
    
    <dl>
        <dt> <?php __("Proposals submitted"); ?>: </dt>
        <dd> <?php echo $proposals; ?> </dd>
    </dl>
    
    <dl>
        <?php $i=0; ?>
        <?php foreach( $countries as $country=>$quant): ?>
        <?php
            $altrow = ($i++%2)?'':'class="altrow"';
        ?>
        <dt <?php echo $altrow ?>> <?php __("Speakers from "); echo $country; ?>: </dt>
        <dd <?php echo $altrow ?>> 
            <?php echo $this->Html->link($quant, array('action'=>'speakersByCountry', 'country'=>$country)); ?> 
            <?php echo __('with'); ?>
            <?php echo $this->Html->link($proposalsByCountry[$country], array('action'=>'proposalsByCountry','country'=>$country)); ?>
            <?php __('proposals'); ?>
        </dd>
        <?php endforeach; ?>
    </dl>
</div>