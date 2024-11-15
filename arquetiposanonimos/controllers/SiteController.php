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
                // Atualiza a ordem das imagens no campo 'files'
                $model->files = $newOrder;
            }

            // Verifica se a imagem principal foi enviada corretamente
            $imageInput = isset($_FILES['Films']['name']['imgInput']) && $_FILES['Films']['error']['imgInput'] == UPLOAD_ERR_OK
                ? $_FILES['Films']['tmp_name']['imgInput'] : null;

            // Verifica se os arquivos adicionais foram enviados corretamente
            $filesInput = [];
            if (isset($_FILES['Films']['name']['filesInput'])) {
                foreach ($_FILES['Films']['name']['filesInput'] as $key => $value) {
                    if ($_FILES['Films']['error']['filesInput'][$key] == UPLOAD_ERR_OK) {
                        $filesInput[] = $_FILES['Films']['tmp_name']['filesInput'][$key];
                    }
                }
            }

            // Salva os arquivos se foram enviados
            if ($model->saveFiles($imageInput, $filesInput) && $model->save()) {
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

    public function actionFilmDeleteImage()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $file = Yii::$app->request->post('file');

        if ($file && file_exists(Yii::getAlias('@webroot') . '/' . $file)) {
            // Exclui o arquivo fisicamente
            unlink(Yii::getAlias('@webroot') . '/' . $file);

            // Atualiza o banco de dados para remover o arquivo da lista de arquivos
            $model = Films::findOne(['files' => $file]);
            if ($model) {
                $files = explode(',', $model->files);
                $key = array_search($file, $files);
                if ($key !== false) {
                    unset($files[$key]);
                }
                $model->files = implode(',', $files);
                $model->save();
            }

            return ['success' => true];
        }

        return ['success' => false];
    }
}
