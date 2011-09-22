<div class="users view">
<h2><?php  __('User');?></h2>
<?php
        echo $this->Form->create(array('action' => 'login'));
        echo $this->Form->inputs(array(
                'legend' => false,
                'username' => array('label' => 'Username/Email'),
                'password'
            ));
        echo $this->Form->end(array('label' => 'Login','class' => 'blue'));
    ?>
</div>
