<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Screenings */

$this->title = 'Create Screenings';
$this->params['breadcrumbs'][] = ['label' => 'Screenings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="screenings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
