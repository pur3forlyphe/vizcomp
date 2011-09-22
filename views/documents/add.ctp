<div class="documents form">
<?php echo $this->Form->create('Document', array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Add Document'); ?></legend>
	<?php
		echo $this->Form->input('file', array('type' => 'file'));
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Documents', true), array('action' => 'index'));?></li>
	</ul>
</div>