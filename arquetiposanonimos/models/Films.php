<?php
namespace app\models;

use Yii;
use yii\web\UploadedFile;

class Films extends \yii\db\ActiveRecord
{
    public $filesInput; // Para o upload de múltiplas imagens
    public $imgInput; // Para o upload da imagem principal

    public static function tableName()
    {
        return 'films';
    }

    public function rules()
    {
        return [
            [['title', 'description', 'slug', 'views'], 'required'],
            [['title', 'description', 'slug'], 'string'],
            [['views'], 'integer'],
            [['files', 'img'], 'string'],
        ];
    }

    // Método para salvar a imagem principal
    public function saveMainImage($imageInput)
    {
        // Verifica se já existe uma imagem principal
        if ($this->img) {
            return true; // Já existe uma imagem principal, não salva novamente
        }

        // Se não existe, salva a nova imagem principal
        $imagePath = 'uploads/' . uniqid() . '.' . $imageInput->extension;
        if ($imageInput->saveAs(Yii::getAlias('@webroot') . '/' . $imagePath)) {
            $this->img = $imagePath;
        } else {
            return false; // Falhou ao salvar a imagem
        }

        return true;
    }

    // Método para salvar arquivos adicionais
    public function saveAdditionalFiles($filesInput)
    {
        $filePaths = [];
        foreach ($filesInput as $file) {
            $filePath = 'uploads/' . uniqid() . '.' . $file->extension;
            if ($file->saveAs(Yii::getAlias('@webroot') . '/' . $filePath)) {
                $filePaths[] = $filePath;
            } else {
                return false; // Falhou ao salvar algum arquivo
            }
        }

        $this->files = implode(',', $filePaths); // Salva a lista de arquivos no campo `files`
        return true;
    }
}
