<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ScreeningSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Screenings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="screenings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Screenings', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date_created',
            'created_by',
            'notes',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
