<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'price',
            'picture',
            'category_id',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            [
                    'class' => 'yii\grid\DataColumn',
                    'header' => 'Picture',
                    'format' => 'raw',
                    'value' => function($data){
                        return "<img widht='500px' height='200px' src='".Url::to(['item/view-picture', 'nama' =>$data->picture])."'>";
                    }

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
