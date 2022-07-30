<?php

$this->title = 'My Yii Application';

use app\models\Item;
use app\models\Item_category;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;

?>

<div class="site-index">
   <?php if(Yii::$app->session->hasFlash('msg-error')):?>
        <div class="alert alert-danger">
           <?php echo Yii::$app->session->getFlash('msg-error');?>
        </div>
    <?php endif; ?>

<?php $form = ActiveForm::begin(['action' => ['site/index'], 'options' => ['method' => 'post']]); ?>
    <select name="category">
        <option value="0">Select Category</option>
        <?php foreach (\app\models\Item_category::find()->all() as $c): ?> 
            <option value="<?= $c->id;?>"><?= $c->name;?></option>
        <?php endforeach; ?>
        <option value=""></option>
    </select>
    <div class="form-group">
        <?= Html::submitButton('Filter', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

<?php foreach ($models as $model): ?>
    <?= $this->render('_list_item', ['model' => $model]); ?>
    <br/>
<?php endforeach; ?>

<?=
    LinkPager::widget([
        'pagination' => $pagination,
    ]);

?>

</div>
 