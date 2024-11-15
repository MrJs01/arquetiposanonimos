<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
<input type="file" name="imageInput">

<!-- Arquivos de imagem múltiplos -->
<input type="file" name="filesInput[]" multiple>

<!-- Exibir imagens existentes -->
<div class="form-group">
    <label for="current-images">Current Images</label>
    <ul id="sortable-images">
        <?php foreach ($model->getImages() as $image): ?>
            <li data-id="<?= $image->id ?>">
                <img src="<?= $image->url ?>" alt="Image" width="100" height="100">
                <input type="hidden" name="image_order[]" value="<?= $image->id ?>">
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- Adicionar script para permitir reordenação -->
<?php
$js = <<<JS
    // Inicializar o Sortable.js para permitir a reordenação
    new Sortable(document.getElementById('sortable-images'), {
        onEnd(evt) {
            // Atualiza os valores dos inputs hidden com a nova ordem
            let order = [];
            document.querySelectorAll('#sortable-images li input').forEach(input => {
                order.push(input.value);
            });
            console.log(order); // Você pode verificar a ordem das imagens
        }
    });
JS;
$this->registerJs($js);
?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
