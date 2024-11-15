<?php
// Aqui você pode exibir as imagens salvas no banco de dados
$files = explode(',', $model->files); // Quebrando os caminhos das imagens em um array
?>
<div class="form-group">
    <label>Reordenar Imagens</label>
    <ul id="sortable">
        <?php foreach ($files as $file): ?>
            <?php if ($file): ?>
                <li class="ui-state-default" data-file="<?= $file ?>">
                    <img src="<?= Yii::getAlias('@web') . '/' . $file ?>" width="100" alt="image">
                    <input type="hidden" name="reordered_files[]" value="<?= $file ?>">
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(function() {
        // Permite arrastar e soltar
        $("#sortable").sortable({
            update: function(event, ui) {
                // Quando a lista for alterada, atualiza a ordem dos arquivos
                var reorderedFiles = [];
                $('#sortable li').each(function() {
                    reorderedFiles.push($(this).data('file'));
                });
                
                // Atualiza os valores do input hidden
                $("input[name='reordered_files[]']").each(function(index) {
                    $(this).val(reorderedFiles[index]);
                });
            }
        });
        $("#sortable").disableSelection();
    });
</script>
