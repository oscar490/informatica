<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenadores */

$this->title = $model->marca . ' ' . $model->modelo;
$this->params['breadcrumbs'][] = ['label' => 'Ordenadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->marca . ' ' . $model->modelo, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="ordenadores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items'=>$items,
    ]) ?>

</div>
