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
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }



    public function actionAdminFilm($id = null)
    {
        $model = $id ? Films::findOne($id) : new Films();

        // Verifica se é um POST request
        if ($model->load(Yii::$app->request->post())) {
            // Recebe os arquivos de imagem
            $model->filesInput = UploadedFile::getInstances($model, 'filesInput');
            $model->imgInput = UploadedFile::getInstance($model, 'imgInput');

            if ($model->uploadFiles() && $model->save()) {
                Yii::$app->session->setFlash('success', 'Film saved successfully!');
                return $this->redirect(['app/admin/film', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'There was an error saving the film. Errors: ' . json_encode($model->getErrors()));
            }
        }

        return $this->render('app/admin/film', [
            'model' => $model,
        ]);
    }
}
