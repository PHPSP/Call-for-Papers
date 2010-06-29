<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('PHP Conference Brazil - Call for Papers'); ?>
		<?php 
		    if ( $title_for_layout ) {
		        //echo '[',$title_for_layout,']';
		    } 
		?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('style');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($this->Html->image('logo.jpg'), 'http://phpconf.com.br', array('escape' => false)); ?></h1>
			<?php if ( isset($logged) && $logged ): ?>
			<ul id="menu">
			    <li> <?php echo $this->Html->link(__('New proposal',true), array('controller'=>'proposals', 'action'=> 'add')); ?> </li>
			    <li> <?php echo $this->Html->link(__('My proposals',true), array('controller'=>'proposals', 'action'=> 'index')); ?> </li>
			    <li> <?php echo $this->Html->link(__('My account',true), array('controller'=>'speakers', 'action'=> 'edit')); ?> </li>
			    <li> <?php echo $this->Html->link(__('Logout',true), array('controller'=>'users', 'action'=> 'logout')); ?> </li>
			</ul>
			<?php endif; ?>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			PHP Conference Brasil - PHPSP
			<?php echo $this->Html->link($this->Html->image('flag-bra.png'),array('lang'=>'por'), array('escape'=>false)); ?>
			<?php echo $this->Html->link($this->Html->image('flag-eng.png'),array('lang'=>'eng'), array('escape'=>false)); ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>