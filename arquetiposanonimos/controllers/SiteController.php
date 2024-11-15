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
    public function actionView($slug)
    {
        // layout main
        $this->layout = 'main-app';

        return $this->render('app/view', [
            'slug' => $slug
        ]);
    }



    public function actionAdminFilm($id = null)
    {
        $this->layout = 'main-app';
        $model = $id ? Films::findOne($id) : new Films();
    
        // Verifica se é um POST request
        if ($model->load(Yii::$app->request->post())) {
    
            // Recupera a nova ordem das imagens
            $imageOrder = Yii::$app->request->post('image_order', []);
            
            // Processar os arquivos
            $imageInput = $_FILES['imageInput'];
            $filesInput = $_FILES['filesInput'];
    
            // Salvar as novas imagens
            $model->saveFiles($imageInput, $filesInput);
            
            // Atualizar a ordem das imagens
            if (!empty($imageOrder)) {
                // Exemplo de como reorganizar as imagens
                $model->updateImageOrder($imageOrder);
            }
    
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
