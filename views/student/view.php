<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">

    <h1><?= Html::encode($model->second_name) ?> <?= Html::encode($model->name) ?> <?= Html::encode($model->third_name) ?>  (<?= Html::encode($model->group->title) ?>)</h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы в своем уме?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Группа',
                'value' => $model->group->title,
            ],
            'second_name',
            'name',
            'third_name',
            'nzk',
            [
                'label' => 'Староста',
                'value' => $model->starosta ? 'Да': 'Нет',
            ],
        ],
    ]) ?>

</div>
