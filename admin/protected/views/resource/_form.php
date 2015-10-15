<?php
/* @var $this ResourceController */
/* @var $model Resource */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resource-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'dice'); ?>
		<?php echo $form->textField($model,'dice'); ?>
		<?php echo $form->error($model,'dice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'defense'); ?>
		<?php echo $form->textField($model,'defense'); ?>
		<?php echo $form->error($model,'defense'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'attack'); ?>
		<?php echo $form->textField($model,'attack'); ?>
		<?php echo $form->error($model,'attack'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->