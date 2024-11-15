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

            // Validações para os uploads de arquivos
            [['filesInput'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 10],
            [['imgInput'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'], // A imagem principal será obrigatória
        ];
    }



    /**
     * Salva os arquivos de imagem enviados.
     */
    public function uploadFiles()
    {
        if ($this->validate()) {
            // Para a imagem principal
            if ($this->imgInput) {
                $imgPath = \Yii::getAlias('@webroot') . 'uploads/films/' . uniqid() . '.' . $this->imgInput->extension;
                if ($this->imgInput->saveAs($imgPath)) {
                    $this->img = $imgPath; // Salva o caminho da imagem principal
                }
            }

            // Para os arquivos de imagem múltiplos
            if ($this->filesInput) {
                $filePaths = [];
                foreach ($this->filesInput as $file) {
                    $filePath = \Yii::getAlias('@webroot') . 'uploads/films/' . uniqid() . '.' . $file->extension;
                    if ($file->saveAs($filePath)) {
                        $filePaths[] = $filePath;
                    }
                }
                $this->files = implode(',', $filePaths); // Salva os caminhos dos arquivos
            }

            return true;
        }

        return false;
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
}
