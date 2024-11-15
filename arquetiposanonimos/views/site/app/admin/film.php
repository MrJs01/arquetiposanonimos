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
    <?php
    // Exibe imagens já salvas
    foreach (explode(',', $model->files) as $file): 
        if (!empty($file)): 
    ?>
        <div class="sortable-item" data-id="<?= $file ?>">
            <img src="<?= Yii::$app->urlManager->baseUrl . '/' . $file ?>" alt="Image" class="sortable-image" style="width: 150px; height: 150px; object-fit: cover;">
            <p><?= basename($file) ?></p>
            <!-- Botão de excluir imagem -->
            <button type="button" class="btn btn-danger btn-sm delete-image" data-file="<?= $file ?>">Excluir</button>
        </div>
    <?php endif; endforeach; ?>
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

    // Função para excluir imagens
    document.querySelectorAll('.delete-image').forEach(button => {
        button.addEventListener('click', function() {
            var fileToDelete = this.getAttribute('data-file');
            var itemToDelete = this.closest('.sortable-item');
            itemToDelete.remove();

            // Atualiza o campo 'newOrder' ao remover a imagem
            let newOrder = [];
            document.querySelectorAll('#sortable-images .sortable-item').forEach((item, index) => {
                newOrder.push(item.getAttribute('data-id')); // Pega o ID da imagem
            });
            document.getElementById('newOrder').value = newOrder.join(',');

            // Envia o nome do arquivo para o servidor para ser excluído
            // Isso pode ser feito através de uma requisição AJAX para o backend
            fetch('<?= Yii::$app->urlManager->createUrl(['app/admin/film-delete-image']) ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ file: fileToDelete })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Imagem excluída com sucesso!');
                } else {
                    console.log('Erro ao excluir a imagem!');
                }
            });
        });
    });
</script>
