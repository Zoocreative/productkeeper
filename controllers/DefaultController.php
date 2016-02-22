<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use app\components\ZController;
use yii\filters\VerbFilter;

//Models
use app\models\Tag;

class DefaultController extends ZController
{
    public $layout = 'inner.haml';
    public $defaultAction = 'index';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'store' => ['post'],
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /////////////////////////////////////////////////////////////////
    // ************************** INDEX ***************************//
    /////////////////////////////////////////////////////////////////

    public function actionIndex()
    {
        // $searchModel  = Yii::createObject(EventSearch::className());
        // $data = $searchModel->search(Yii::$app->request->get());

        // $pageTitle = Yii::$app->params['siteName']." - ".Yii::t('interface',"Events");

        // return $this->render('index.haml',[
        //     'data' => $data,
        //     'pageTitle' => $pageTitle,
        //     'searchModel' => $searchModel
        // ]);
        return "it's Working so it is";
    }

    /////////////////////////////////////////////////////////////////
    // *************************** CRUD ***************************//
    /////////////////////////////////////////////////////////////////

    public function actionCreate()
    {
    }

    public function actionUpdate($id)
    {
    }

    public function actionStore($id)
    {
    }

    public function actionDelete($id=null)
    {
    }

    /////////////////////////////////////////////////////////////////
    // ************************** TRASH ***************************//
    /////////////////////////////////////////////////////////////////

    public function actionTrash()
    {
    }

    public function actionRestore($id)
    {
    }

    /////////////////////////////////////////////////////////////////
    // ************************** STATUS **************************//
    /////////////////////////////////////////////////////////////////

    public function actionStatus($id)
    {
        $model = Event::findOne($id);

        if ($model->status == 1)
            $model->status = 0;
        else
            $model->status = 1;

        $model->save();
        return $this->redirect(Yii::$app->request->referrer);
    }

}
