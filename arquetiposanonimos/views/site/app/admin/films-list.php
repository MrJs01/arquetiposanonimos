<?php
// '/app/admin/films' => 'site/admin-films',

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FilmsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Films';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="films-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Films', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <!-- mostrar lista de filmes e button editar -->
    <?php
    $films = \app\models\Films::find()->all();
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($films as $film): ?>
                <tr>
                    <th scope="row"><?= $film->id ?></th>
                    <td><?= $film->title ?></td>
                    <td><?= $film->description ?></td>
                    <td>
                        <a href="/app/admin/film/<?= $film->id ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>