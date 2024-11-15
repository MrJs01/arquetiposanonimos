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

            [['imageInput'], 'file', 'extensions' => 'jpg, jpeg, png', 'skipOnEmpty' => true],
            [['filesInput'], 'file', 'extensions' => 'jpg, jpeg, png', 'skipOnEmpty' => true, 'maxFiles' => 10],
       

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
}
