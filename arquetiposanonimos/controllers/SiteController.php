<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Films;
// UploadedFile
use app\models\UploadForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionApp()
    {
        // layout main
        $this->layout = 'main-app';

        return $this->render('app/index');
    }

    // app-view
    public function actionView($file_name)
    {
        // layout main
        $this->layout = 'main-app';

        return $this->render('app/view', [
            'file_name' => $file_name
        ]);
    }



    public function actionAdminFilm($id = null)
    {
        $model = $id ? Films::findOne($id) : new Films();

        // Verifica se é um POST request
        if ($model->load(Yii::$app->request->post())) {

            // files imageInput e filesInput
            $imageInput = UploadedFile::getInstance($model, 'imageInput');
            $filesInput = UploadedFile::getInstances($model, 'filesInput');

            // Define o diretório onde as imagens serão armazenadas
            $uploadPath = Yii::getAlias('@webroot/uploads/films/');

            // Verifica se foi enviado uma imagem principal
            if ($imageInput) {
                $imageName = $imageInput->baseName . '.' . $imageInput->extension;
                // Salva a imagem principal
                if ($imageInput->saveAs($uploadPath . $imageName)) {
                    $model->img = $imageName;
                }
            }

            // Verifica se foram enviados arquivos de imagem
            if ($filesInput) {
                $model->files = [];
                foreach ($filesInput as $file) {
                    $fileName = $file->baseName . '.' . $file->extension;
                    // Salva as imagens adicionais
                    if ($file->saveAs($uploadPath . $fileName)) {
                        $model->files[] = $fileName;
                    }
                }
            }

            // Tenta salvar o modelo no banco de dados
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Film saved successfully!');
                return $this->redirect(['app/admin/film', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'There was an error saving the film. Erros: ' . json_encode($model->errors));
            }
        }

        return $this->render('app/admin/film', [
            'model' => $model,
        ]);
    }
}
