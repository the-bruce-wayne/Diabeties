<?php
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Hospitals;
use backend\models\Clinics;

/* @var $this yii\web\View */
/* @var $model backend\models\Patients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patients-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->dropDownList([ 'MALE' => 'MALE', 'FEMALE' => 'FEMALE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'national_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vision')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'waist')->textInput() ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number_cell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    
    <?=$form->field($model, 'date_of_birth')->widget(DatePicker::className(), ['clientOptions' => ['defaultDate' => '+0','showAnim' => 'fold','changeMonth' => true,'changeYear' => true,'autoSize' => true,'yearRange'=>'-100:+0','dateFormat' => 'php:d M Y']])->textInput();?>

    <?= $form->field($model, 'smart_phone')->dropDownList([ 'TRUE' => 'TRUE', 'FALSE' => 'FALSE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'hospital_id')->dropDownList(
                ArrayHelper::map(Hospitals::find()->all(), 'id', 'hospital_name')
            )?>

    <?= $form->field($model, 'clinic_number_id')->dropDownList(
                ArrayHelper::map(Clinics::find()->all(), 'id', 'name')
            )?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
