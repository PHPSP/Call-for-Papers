<div class="proposals view">
    <h2><?php __('Proposal') ?></h2>
    
    <dl>
        <dt><?php __('Area') ?>:</dt>
        <dd><?php echo $proposal['Area']['name']; ?>&nbsp;</dd>
        
        <dt class="altrow"><?php __('Title') ?>:</dt>
        <dd class="altrow"><?php echo $proposal['Proposal']['title'] ?>&nbsp;</dd>
        
        <dt><?php __('Abstract') ?>:</dt>
        <dd><?php echo $proposal['Proposal']['abstract'] ?>&nbsp;</dd>
        
        <dt class="altrow"><?php __('Description') ?>:</dt>
        <dd class="altrow"><?php echo $proposal['Proposal']['description'] ?>&nbsp;</dd>
        
        <dt><?php __('After the speech, what attendee will know?') ?>:</dt>
        <dd><?php echo $proposal['Proposal']['after'] ?>&nbsp;</dd>
        
        <dt class="altrow"><?php __('Level') ?>:</dt>
        <dd class="altrow"><?php echo $proposal['Level']['name'] ?>&nbsp;</dd>
        
        <dt><?php __('Time') ?>:</dt>
        <dd><?php echo $proposal['Proposal']['time'] ?>min</dd>
    </dl>
    
    <dl>
        <dt class="altrow"><?php __("Speaker") ?></dt>
        <dd class="altrow">
            <?php 
                $firstName = $proposal['Speaker']['firstName'];
                $lastName  = $proposal['Speaker']['lastName'];
                echo $this->Html->link($firstName.' '.$lastName. ' profile', array('controller'=>'speakers','action'=>'view','speaker_id'=>$proposal['Speaker']['id']));
            ?>
        </dd>
    </dl>
</div>