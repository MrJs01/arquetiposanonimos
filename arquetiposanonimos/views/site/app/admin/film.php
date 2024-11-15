<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = $model->isNewRecord ? 'Create Film' : 'Edit Film';

?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'], // Necessário para uploads de arquivos
]); ?>

<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
<?= $form->field($model, 'slug') ?>
<?= $form->field($model, 'views') ?>

<!-- Imagem principal -->
<?= $form->field($model, 'imgInput')->fileInput() ?>

<!-- Arquivos de imagem múltiplos -->
<?= $form->field($model, 'filesInput[]')->fileInput(['multiple' => true]) ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
