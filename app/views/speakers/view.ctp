<div class="speakers view">
    <h2> <?php __('Speaker details') ?> </h2>
    
    <?php if ( count($speaker) <= 0 ): ?>
        
    <?php else: ?>
    <dl>
        <dt> <?php __('Avatar') ?>: </dt>
        <dd> 
            <?php
                $image = ( isset($speaker['Speaker']['image']['small']) ) ? $speaker['Speaker']['image']['small'] : null ;
                if ( ! is_null($image) ) {
                    echo $this->Html->image($image);
                }
            ?> 
        </dd>
        <dt> <?php __('Name') ?>: </dt>
        <dd> <?php echo $speaker['Speaker']['firstName'],'&nbsp;',$speaker['Speaker']['lastName'] ?></dd>
        
        <dt> <?php __('Abstract') ?>: </dt>
        <dd> <?php echo $speaker['Speaker']['abstract']; ?>&nbsp;</dd>
        
        <dt> <?php __('Description') ?>: </dt>
        <dd> <?php echo $speaker['Speaker']['description']; ?>&nbsp;</dd>
        
        <dt> <?php __('Country') ?>: </dt>
        <dd> <?php echo $speaker['Speaker']['country'] ?>&nbsp;</dd>
        
        <dt> <?php __('City') ?>/<?php __('State') ?>: </dt>
        <dd> <?php echo $speaker['Speaker']['city'] ?>/<?php echo $speaker['Speaker']['state'] ?></dd>
        
        <dt> <?php __('Twitter') ?>: </dt>
        <dd> <?php echo $this->Html->link('@'.$speaker['Speaker']['twitter'], 'http://www.twitter.com/'.$speaker['Speaker']['twitter']) ?></dd>
    </dl>
    <?php endif; ?>
</div>