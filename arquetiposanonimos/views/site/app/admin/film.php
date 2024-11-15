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
<?= $form->field($model, 'imgInput')->fileInput() ?>

<!-- Arquivos de imagem múltiplos -->
<?= $form->field($model, 'filesInput[]')->fileInput(['multiple' => true]) ?>

<!-- Este campo armazenará a nova ordem das imagens -->
<?= Html::hiddenInput('newOrder', '', ['id' => 'newOrder']) ?>

<!-- Container para as imagens que serão arrastadas -->
<div id="sortable-images">
    <?php foreach (explode(',', $model->files) as $file): ?>
        <?php if (!empty($file)): ?>
            <div class="sortable-item" data-id="<?= $file ?>">
                <img src="<?= Yii::$app->urlManager->baseUrl . '/' . $file ?>" alt="Image" style="width: 300px; height: 300px; object-fit: contain;">
                <p><?= basename($file) ?></p>
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
    // Inicializa o Sortable no container das imagens
    var sortable = new Sortable(document.getElementById('sortable-images'), {
        animation: 150,
        onEnd(evt) {
            // Envia a nova ordem das imagens para o formulário quando o usuário termina de arranjar
            let newOrder = [];
            const items = evt.from.children;
            for (let i = 0; i < items.length; i++) {
                newOrder.push(items[i].getAttribute('data-id')); // Pega o ID da imagem
            }
            document.getElementById('newOrder').value = newOrder.join(',');
        }
    });
</script>
