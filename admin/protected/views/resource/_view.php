<?php
/* @var $this ResourceController */
/* @var $data Resource */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('defense')); ?>:</b>
	<?php echo CHtml::encode($data->defense); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attack')); ?>:</b>
	<?php echo CHtml::encode($data->attack); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>