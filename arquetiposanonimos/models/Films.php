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
            [['title', 'description', 'files', 'slug', 'img'], 'string'],
            [['views'], 'integer'],
            [['filesInput'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 10],
            [['imgInput'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            // Torna os campos de arquivos não obrigatórios, mas validando se houver arquivo
            [['files'], 'required', 'when' => function ($model) {
                return !empty($model->filesInput);
            }, 'message' => 'Files cannot be blank.'],
            [['img'], 'required', 'when' => function ($model) {
                return !empty($model->imgInput);
            }, 'message' => 'Image (main) cannot be blank.'],
        ];
    }


    /**
     * Salva os arquivos de imagem enviados.
     */
    public function uploadFiles()
    {
        if ($this->validate()) {
            // Para as imagens dos filmes
            if ($this->filesInput) {
                $filePaths = [];
                foreach ($this->filesInput as $file) {
                    $filePath = 'uploads/films/' . uniqid() . '.' . $file->extension;
                    if ($file->saveAs($filePath)) {
                        $filePaths[] = $filePath;
                    }
                }
                $this->files = implode(',', $filePaths);
            }

            // Para a imagem principal
            if ($this->imgInput) {
                $imgPath = 'uploads/films/' . uniqid() . '.' . $this->imgInput->extension;
                if ($this->imgInput->saveAs($imgPath)) {
                    $this->img = $imgPath;
                }
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
