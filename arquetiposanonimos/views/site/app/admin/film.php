<?php
// Aqui você pode exibir as imagens salvas no banco de dados
$files = explode(',', $model->files); // Quebrando os caminhos das imagens em um array
?>
<div class="form-group">
    <label>Reordenar Imagens</label>
    <ul id="sortable">
        <?php foreach ($files as $file): ?>
            <?php if ($file): ?>
                <li class="sortable-item" data-file="<?= $file ?>" draggable="true">
                    <img src="<?= Yii::getAlias('@web') . '/' . $file ?>" width="100" alt="image">
                    <input type="hidden" name="reordered_files[]" value="<?= $file ?>">
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>

<script>
    // Função que inicializa a funcionalidade de arrastar e soltar
    const sortableList = document.getElementById('sortable');

    // Adicionando eventos de drag and drop
    let draggedItem = null;

    // Quando o item começa a ser arrastado
    sortableList.addEventListener('dragstart', function(event) {
        draggedItem = event.target;
        draggedItem.style.opacity = '0.5'; // Tornar o item semi-transparente enquanto arrasta
    });

    // Quando o item termina de ser arrastado
    sortableList.addEventListener('dragend', function() {
        draggedItem.style.opacity = '1'; // Restaura a opacidade do item
        draggedItem = null;
    });

    // Quando um item é arrastado para um item de destino
    sortableList.addEventListener('dragover', function(event) {
        event.preventDefault(); // Permite a operação de arrastar
        const targetItem = event.target;

        // Só pode ser um item de lista (não o próprio <ul>)
        if (targetItem && targetItem !== draggedItem && targetItem.classList.contains('sortable-item')) {
            const bounding = targetItem.getBoundingClientRect();
            const offset = bounding.top + bounding.height / 2;
            if (event.clientY - offset > 0) {
                targetItem.style['border-bottom'] = 'solid 2px #ccc';
                targetItem.style['border-top'] = '';
            } else {
                targetItem.style['border-top'] = 'solid 2px #ccc';
                targetItem.style['border-bottom'] = '';
            }
        }
    });

    // Quando um item é solto dentro da lista
    sortableList.addEventListener('drop', function(event) {
        event.preventDefault();
        const targetItem = event.target;
        if (targetItem && targetItem !== draggedItem && targetItem.classList.contains('sortable-item')) {
            // Troca as posições dos itens
            const bounding = targetItem.getBoundingClientRect();
            const offset = bounding.top + bounding.height / 2;
            if (event.clientY - offset > 0) {
                sortableList.insertBefore(draggedItem, targetItem.nextSibling);
            } else {
                sortableList.insertBefore(draggedItem, targetItem);
            }
            targetItem.style['border-bottom'] = '';
            targetItem.style['border-top'] = '';
        }
    });
</script>
