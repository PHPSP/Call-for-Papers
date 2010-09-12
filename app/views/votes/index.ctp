<div class="votes index">
    <fieldset>
        <legend><?php __("Vote in this Proposal"); ?></legend>
        
        <p> 
            <?php __("Would you like to see this proposal as a session of 60 or 90 minutes in the PHP Conference Brazil 2010?  If you don't know, just refresh this page and see another proposal."); ?>
        </p>
        <dl>
            <dt> <?php __('Title'); ?> </dt>
            <dd>  <?php echo $proposal['Proposal']['title'] ?> </dd>
            
            <dt class="altrow"> <?php __('Abstract'); ?> </dt>
            <dd class="altrow">  <?php echo $proposal['Proposal']['abstract'] ?> </dd>
            
            <dt> <?php __('Description'); ?> </dt>
            <dd>  <?php echo $proposal['Proposal']['description'] ?> </dd>
        </dl>
        
        <div class="clear"></div>
        
        <div id="options">
        <?php $params =  array('action'=>'vote', 'id'=>$proposal['Proposal']['id'], 'key'=>$key);
        
              $params['value'] = 1;
              echo $this->Html->link(__('Yes', true), $params); 
              $params['value'] = 0;
              echo $this->Html->link(__('No', true), $params); 
        ?>
        </div>
    </fieldset>
</div>