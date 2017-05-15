<?php

namespace frontend\controllers;

use frontend\models\UploadForm;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * Picture controller
 */
class PictureController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'delete', 'rotate'],
                'rules' => [
                    [
                        'actions' => ['index', 'delete', 'rotate'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if (!$model->upload()) {
            }
        }

        return $this->render('index', ['model' => $model, 'uploaded' => Yii::$app->user->identity->getMyPictures()]);
    }

    /**
     * @return mixed
     */
    public function actionDelete()
    {
        return Yii::$app->user->identity->removePicture(Yii::$app->request->post('picture'));
    }

    /**
     * @return mixed
     */
    public function actionRotate()
    {
        return Yii::$app->user->identity->rotatePicture(Yii::$app->request->post('picture'));
    }
}
