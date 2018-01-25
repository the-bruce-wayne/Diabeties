<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Patients', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'first_name',
            'last_name',
            // 'other_name',
            'sex',
            'national_id',
            // 'vision',
            // 'waist',
            'phone_number',
            // 'phone_number_cell',
            'email:email',
            // 'address',
            // 'date_of_birth',
            // 'smart_phone',
            // 'created_by',
            // 'date_created',
            // 'note',
            [
                'attribute'=>'hospital_id',
                'value'=>'hospital.hospital_name',
            ],
            [
                    'attribute'=>'clinic_number_id',
                    'value'=>'clinicNumber.name',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
