<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->isNewRecord ? 'Create Film' : 'Edit Film';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
<?= $form->field($model, 'slug') ?>
<?= $form->field($model, 'views') ?>

<!-- Imagem principal -->
<?= $form->field($model, 'imgInput')->fileInput() ?>

<!-- Arquivos de imagem múltiplos -->
<?= $form->field($model, 'filesInput[]')->fileInput(['multiple' => true]) ?>

<!-- Campos ocultos para nova ordem e exclusão -->
<?= Html::hiddenInput('newOrder', '', ['id' => 'newOrder']) ?>
<?= Html::hiddenInput('deletedImages', '', ['id' => 'deletedImages']) ?>

<!-- Container para as imagens -->
<div id="sortable-images" class="row">
    <?php foreach (explode(',', $model->files) as $file): ?>
        <?php if (!empty($file)): ?>
            <div class="col-md-3 sortable-item" data-id="<?= $file ?>">
                <div class="card">
                    <img src="<?= Yii::$app->urlManager->baseUrl . '/' . $file ?>" alt="Image" class="card-img-top" style="height: 150px; object-fit: contain;">
                    <div class="card-body">
                        <p class="card-text"><?= basename($file) ?></p>
                        <button type="button" class="btn btn-danger btn-sm delete-image" data-id="<?= $file ?>">Excluir</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

<!-- Adicionar o script do SortableJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

<script>
    // Inicializa o Sortable para reordenar as imagens
    var sortable = new Sortable(document.getElementById('sortable-images'), {
        animation: 150,
        onEnd(evt) {
            let newOrder = [];
            const items = evt.from.children;
            for (let i = 0; i < items.length; i++) {
                newOrder.push(items[i].getAttribute('data-id'));
            }
            document.getElementById('newOrder').value = newOrder.join(',');
        }
    });

    // Função para excluir a imagem
    document.querySelectorAll('.delete-image').forEach(function(button) {
        button.addEventListener('click', function() {
            var imageId = this.getAttribute('data-id');
            let deletedImages = document.getElementById('deletedImages').value.split(',');
            deletedImages.push(imageId);
            document.getElementById('deletedImages').value = deletedImages.join(',');

            this.closest('.sortable-item').remove();
        });
    });
</script>
