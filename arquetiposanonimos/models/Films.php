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


    public function saveFiles($mainImage, $additionalFiles)
    {
        $savedFiles = [];

        // Salva a imagem principal
        if ($mainImage) {
            $mainImagePath = 'uploads/' . uniqid('img_', true) . '.jpg'; // ou qualquer outra extensão conforme o tipo de imagem
            if (move_uploaded_file($mainImage, Yii::getAlias('@webroot') . '/' . $mainImagePath)) {
                $savedFiles[] = $mainImagePath;
            }
        }

        // Salva os arquivos adicionais
        foreach ($additionalFiles as $file) {
            $filePath = 'uploads/' . uniqid('img_', true) . '.jpg'; // ou qualquer outra extensão conforme o tipo de imagem
            if (move_uploaded_file($file, Yii::getAlias('@webroot') . '/' . $filePath)) {
                $savedFiles[] = $filePath;
            }
        }

        if (!empty($savedFiles)) {
            // Atualiza o campo 'files' com os arquivos salvos
            $this->files = implode(',', $savedFiles); // Salva como string separada por vírgulas
            return true;
        }

        return false;
    }
}
