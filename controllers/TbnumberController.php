<?php

namespace app\controllers;

use app\models\Tbnumber;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TBnumberController implements the CRUD actions for Tbnumber model.
 */
class TbnumberController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Tbnumber models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tbnumber::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'pk_number' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tbnumber model.
     * @param int $pk_number Pk Number
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($pk_number)
    {
        return $this->render('view', [
            'model' => $this->findModel($pk_number),
        ]);
    }

    /**
     * Creates a new Tbnumber model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tbnumber();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'pk_number' => $model->pk_number]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tbnumber model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $pk_number Pk Number
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($pk_number)
    {
        $model = $this->findModel($pk_number);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'pk_number' => $model->pk_number]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tbnumber model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $pk_number Pk Number
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($pk_number)
    {
        $this->findModel($pk_number)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tbnumber model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $pk_number Pk Number
     * @return Tbnumber the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($pk_number)
    {
        if (($model = Tbnumber::findOne(['pk_number' => $pk_number])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
