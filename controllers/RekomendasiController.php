<?php

namespace app\controllers;

use app\models\Rekomendasi;
use app\models\RekomendasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RekomendasiController implements the CRUD actions for Rekomendasi model.
 */
class RekomendasiController extends Controller
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
     * Lists all Rekomendasi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RekomendasiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rekomendasi model.
     * @param string $Judul Judul
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Judul)
    {
        return $this->render('view', [
            'model' => $this->findModel($Judul),
        ]);
    }

    /**
     * Creates a new Rekomendasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Rekomendasi();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Judul' => $model->Judul]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rekomendasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $Judul Judul
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Judul)
    {
        $model = $this->findModel($Judul);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Judul' => $model->Judul]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Rekomendasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Judul Judul
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Judul)
    {
        $this->findModel($Judul)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rekomendasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Judul Judul
     * @return Rekomendasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Judul)
    {
        if (($model = Rekomendasi::findOne(['Judul' => $Judul])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
