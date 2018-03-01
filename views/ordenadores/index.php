<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Dispositivos;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdenadoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ordenadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordenadores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'codigo',
            'marca',
            'modelo',
            'aula.denominacion',
            [
                'label'=>'Número de dipositivos',
                'value'=> function($data) {
                    $dispositivos = Dispositivos::find()
                        ->where(['ordenador_id'=>$data->id]);
                    return $dispositivos->count();
                }
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
