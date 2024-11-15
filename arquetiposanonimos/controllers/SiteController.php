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

            // Verifica e salva a imagem principal
            $imageInput = isset($_FILES['Films']['name']['imgInput']) && $_FILES['Films']['error']['imgInput'] == UPLOAD_ERR_OK
                ? $_FILES['Films']['tmp_name']['imgInput'] : null;

            // Verifica e salva os arquivos adicionais
            $filesInput = isset($_FILES['Films']['name']['filesInput']) && $_FILES['Films']['error']['filesInput'][0] == UPLOAD_ERR_OK
                ? $_FILES['Films']['tmp_name']['filesInput'] : [];

            // Salva as imagens
            if ($imageInput || $filesInput) {
                if ($imageInput) {
                    // Salva a imagem principal
                    $imagePath = 'uploads/' . uniqid() . '.' . pathinfo($_FILES['Films']['name']['imgInput'], PATHINFO_EXTENSION);
                    if (!move_uploaded_file($imageInput, Yii::getAlias('@webroot') . '/' . $imagePath)) {
                        return false; // Se falhar ao mover a imagem principal
                    }
                    $model->img = $imagePath;
                }

                // Processa as imagens adicionais
                if ($filesInput) {
                    $filePaths = [];
                    foreach ($filesInput as $file) {
                        $filePath = 'uploads/' . uniqid() . '.' . pathinfo($file, PATHINFO_EXTENSION);
                        if (move_uploaded_file($file, Yii::getAlias('@webroot') . '/' . $filePath)) {
                            $filePaths[] = $filePath;
                        } else {
                            return false; // Se falhar ao mover algum arquivo adicional
                        }
                    }
                    // Atualiza o campo `files` com a nova lista de imagens
                    $model->files = implode(',', $filePaths);
                }
            }

            // Tenta salvar o modelo
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
}
