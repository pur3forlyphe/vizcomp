<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <?php echo $this->Html->charset(); ?>
 <title>
  <?php __('VizComp'); ?>
  <?php echo $title_for_layout; ?>
 </title>
 <?php
  echo $this->Html->meta('icon');

  echo $this->Html->css('cake.generic.css');
  
  echo $this->Html->css('video-js.css');
    
  echo $this->Html->script('libs/jquery-1.6.2.min.js');

  echo $this->Html->script('libs/modernizr-2.0.6.min.js');

  echo $this->Html->script('libs/dd_belatedpng.js');
  
  echo $this->Html->script('script.js');
  
  echo $this->Html->script('video-js/video.js');

  echo $scripts_for_layout;
  
  ?>
</head>
<body>
<header>
	<?php
		echo $this->Html->link(__('Home', true), '/pages/home');
		if (!empty($currentUser['User'])){
			echo $this->Html->link(__(ucfirst($currentUser['User']['username']), true), array ('controller' => 'users', 'action' => 'view'));
			echo $this->Html->link(__('Logout', true), array('controller' => 'users', 'action' => 'logout'));
		} else if (empty ($currentUser)) {
			echo $this->Html->link(__('Login', true), array('controller' => 'users', 'action' => 'login'));
		}
	  ?>
</header>
<h1>
VizComp
</h1>
 <div id="content">

  <?php echo $this->Session->flash(); ?>

  <?php echo $content_for_layout; ?>

 </div>
</body>
</html>