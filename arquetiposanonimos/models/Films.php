<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "films".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $files
 * @property string $slug
 * @property int $views
 * @property string $img
 */
class Films extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile[]
     */
    public $filesInput; // Para o upload de múltiplas imagens
    public $imgInput; // Para o upload da imagem principal

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'films';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'slug', 'views'], 'required'],
            [['title', 'description', 'slug'], 'string'],
            [['views'], 'integer'],
            [['files', 'img'], 'string'],



        ];
    }




    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'files' => 'Files (separate by commas)',
            'slug' => 'Slug',
            'views' => 'Views',
            'img' => 'Image (main)',
        ];
    }


    public function saveFiles($imageInput, $filesInput)
    {
        // Salvar a imagem principal
        if ($imageInput) {
            $imagePath = 'uploads/' . uniqid() . '.' . pathinfo($imageInput, PATHINFO_EXTENSION);
            if (move_uploaded_file($imageInput, Yii::getAlias('@webroot') . '/' . $imagePath)) {
                $this->img = $imagePath;
            } else {
                return false; // Se falhar ao mover a imagem
            }
        }

        // Salvar os arquivos adicionais
        if ($filesInput) {
            $filePaths = [];
            foreach ($filesInput as $file) {
                $filePath = 'uploads/' . uniqid() . '.' . pathinfo($file, PATHINFO_EXTENSION);
                if (move_uploaded_file($file, Yii::getAlias('@webroot') . '/' . $filePath)) {
                    $filePaths[] = $filePath;
                } else {
                    return false; // Se falhar ao mover algum arquivo
                }
            }

            $this->files = implode(',', $filePaths); // Salva a lista de arquivos no campo `files`
        }

        return true;
    }
}
