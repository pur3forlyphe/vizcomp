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
    
  echo $this->Html->script('libs/jquery-1.5.1.min.js');

  echo $this->Html->script('libs/modernizr-1.7.min.js');

  echo $this->Html->script('libs/dd_belatedpng.js');  

  echo $scripts_for_layout;
 ?>
</head>
<body>
<header>
    <?php 
        echo $this->Html->link(__('Home', true), '/pages/home');
        if (!empty($user['User'])){
            echo $this->Html->link(__(ucfirst($user['User']['username']), true), array ('controller' => 'users', 'action' => 'view'));
            echo $this->Html->link(__('Logout', true), array('controller' => 'users', 'action' => 'logout'));
        } else if (empty ($user)) {
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