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

            $imageInput = Yii::$app->request->files['imageInput'];
            $filesInput = Yii::$app->request->files['filesInput'];
    
            // Verifica se foi enviado uma imagem principal
            if ($imageInput) {
                $model->img = $imageInput->name;
            }
    
            // Verifica se foram enviados arquivos de imagem
            if ($filesInput) {
                $model->files = json_encode($filesInput);
            }

    
            // Tenta fazer o upload dos arquivos
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
