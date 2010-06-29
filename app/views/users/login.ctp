<div id="users login">
    <?php
        $session->flash('auth');
        echo $form->create('User', array('action'=>'login'));
        
        echo $form->inputs(array(
        	'legend' => __('Login', true),
        	'email',
        	'password'			
        ));
        echo $form->end(__('Login',true));
		echo $this->Html->link(__('Register', true), array('controller' => 'users', 'action' => 'register'));
    ?>
</div>