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
        // salvar em /web/uploads e verificar erros
        try {
            // Verifica se a imagem principal foi recebida corretamente
            if ($imageInput && isset($imageInput['tmp_name']) && $imageInput['tmp_name']) {
                $image = UploadedFile::getInstanceByName('imageInput'); // Usando 'imageInput' diretamente
                if ($image && $image->tempName) {
                    $image->saveAs('uploads/' . $image->baseName . '.' . $image->extension);
                    $this->img = 'uploads/' . $image->baseName . '.' . $image->extension;
                } else {
                    throw new \Exception("Erro ao carregar a imagem principal.");
                }
            }

            // Verifica se os arquivos adicionais foram recebidos corretamente
            if ($filesInput && isset($filesInput['tmp_name']) && is_array($filesInput['tmp_name'])) {
                $files = UploadedFile::getInstancesByName('filesInput'); // Usando 'filesInput' diretamente
                foreach ($files as $file) {
                    if ($file && $file->tempName) {
                        $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
                        $this->files .= 'uploads/' . $file->baseName . '.' . $file->extension . ',';
                    } else {
                        throw new \Exception("Erro ao carregar um dos arquivos.");
                    }
                }
            }

            return true;
        } catch (\Exception $e) {
            // Captura e exibe o erro para depuração
            Yii::error("Erro ao salvar os arquivos: " . $e->getMessage());
            return false;
        }
    }
}
