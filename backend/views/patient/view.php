<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Patients */

$this->title = $model->first_name . " " .  $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'other_name',
            'sex',
            'national_id',
            'vision',
            'waist',
            'phone_number',
            'phone_number_cell',
            'email:email',
            'address',
            'date_of_birth',
            'smart_phone',
            'created_by',
            'date_created',
            'note',
            'hospital.hospital_name',
            'clinicNumber.name',
        ],
    ]) ?>

</div>
