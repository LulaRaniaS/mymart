<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>

<article class="item" data-key="<?= $model->id;?>">
	<?=
	"<img widht='300px' height='200px' src='".Url::to(['item/view-picture', 'nama' => $model->picture])."'>";
	?>
	<h2 class="title">
	<?=
	Html::a(Html::encode($model->name),
	Url::toRoute(['post/show', 'id' => $model->id]), ['title' => $model->name])?>
	</h2>
	<p>Category : <?= $model->category_name ?></p>

	<div class="item-detail">
		<?= Html::encode('Rp. ' . $model->price); ?>
		<br>
		<?php if(!Yii::$app->user->isGuest):?>
			<?= Html::a('Buy', ['item/view', 'id' => $model->id], ['class' => 'btn btn-success'])?>
		<?php else:?>
			<br>
			<small class="text-danger">Please login to buy this item.</small>
		<?php endif; ?>
	</div>
	<hr>
</article>
