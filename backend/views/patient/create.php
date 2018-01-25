<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Patients */

$this->title = 'Create Patients';
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
