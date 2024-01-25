<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Anggota $model */

$this->title = 'Create Anggota';
$this->params['breadcrumbs'][] = ['label' => 'Anggotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
