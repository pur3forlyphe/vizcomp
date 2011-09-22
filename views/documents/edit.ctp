<div class="documents form">
<?php echo $this->Form->create('Document');?>
	<fieldset>
		<legend><?php __('Edit Document'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('file', array('type' => 'file'));
		echo $this->Form->input('description');
		echo $this->Form->input('client_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Document.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Document.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Documents', true), array('action' => 'index'));?></li>
	</ul>
</div>