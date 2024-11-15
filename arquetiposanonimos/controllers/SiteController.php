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

        if ($model->load(Yii::$app->request->post())) {
            // Recupera a nova ordem das imagens
            $newOrder = Yii::$app->request->post('newOrder', '');
            if ($newOrder) {
                $model->files = $newOrder;
            }

            // Recupera as imagens excluídas
            $deletedImages = Yii::$app->request->post('deletedImages', '');
            if ($deletedImages) {
                $deletedImages = explode(',', $deletedImages);
                foreach ($deletedImages as $deletedImage) {
                    if (!empty($deletedImage)) {
                        // Exclui a imagem física
                        @unlink(Yii::getAlias('@webroot') . '/' . $deletedImage);
                    }
                }
            }

            // Verifica e processa a imagem principal
            $imageInput = UploadedFile::getInstance($model, 'imgInput');
            $filesInput = UploadedFile::getInstances($model, 'filesInput');

            // Salva as imagens (se novas forem carregadas)
            if ($imageInput || $filesInput) {
                // Se uma imagem principal foi carregada, salvá-la
                if ($imageInput) {
                    $model->saveMainImage($imageInput);
                }

                // Salva os arquivos adicionais
                if ($filesInput) {
                    $model->saveAdditionalFiles($filesInput);
                }
            }

            // Tenta salvar o modelo
            // remover ultima imagem do imgs
            $model->files = explode(',', $model->files);
            $model->files = array_slice($model->files, 0, -1);
            $model->files = implode(',', $model->files);
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Film saved successfully!');
                return $this->redirect(['app/admin/film', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'There was an error saving the film. Errors: ' . json_encode($model->errors));
            }
        }

        return $this->render('app/admin/film', [
            'model' => $model,
        ]);
    }


    // '/app/admin/films' => 'site/admin-films',

    public function actionAdminFilms()
    {
        $this->layout = 'main-app';
        $films = Films::find()->all();
        return $this->render('app/admin/films-list', [
            'films' => $films
        ]);
    }
}
