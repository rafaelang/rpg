<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Resource;

/* @var $this yii\web\View */
/* @var $model app\models\Player */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="player-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'resource_id')->dropDownList(ArrayHelper::map(Resource::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'resource_id')->textInput() ?>

    <?= $form->field($model, 'speed')->textInput() ?>

    <?= $form->field($model, 'strong')->textInput() ?>

    <?= $form->field($model, 'life')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
