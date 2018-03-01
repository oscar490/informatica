<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenadores */

$this->title = "$model->marca: $model->modelo";
$this->params['breadcrumbs'][] = ['label' => 'Ordenadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordenadores-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
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

            'codigo',
            'marca',
            'modelo',
            'aula.denominacion',
        ],
    ]) ?>

    <h3>Dispositivos instalados</h3>
    <?= GridView::widget([
        'dataProvider'=>$dataProvider,
        'columns'=>[
            'codigo',
            'marca',
            'modelo',
            'tipo.denominacion',
        ]
    ])?>

</div>
