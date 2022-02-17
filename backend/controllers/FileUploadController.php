<?php

namespace backend\controllers;

use Yii;
use common\models\Kategori;
use common\models\KategoriGame;
use common\models\Layanan;
use common\models\FileUpload;
use backend\models\FileUploadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\FileUploadForm;

/**
 * GambarController implements the CRUD actions for Gambar model.
 */
class FileUploadController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FileUpload models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileUploadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gambar model.
     * @param integer $session_upload_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($session_upload_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($session_upload_id),
        ]);
    }

    /**
     * Creates a new FileUpload model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($session_upload_id, $pathName)
    {
        $model = new FileUploadForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->file_image = UploadedFile::getInstance($model, 'file_image');
            
            if ($model->validate()) {
                if ($pathName === 'kategori') {
                    $path     = Yii::getAlias('@common/uploads/kategori/');
                    $data     = Kategori::getFilename($session_upload_id);
                    $filename = strtolower($data->nama_kategori).'.'.$model->file_image->extension;
                    $redirect = ['kategori/view', 'kategori_id' => $data->kategori_id];
                } elseif ($pathName === 'layanan') {
                    $path     = Yii::getAlias('@common/uploads/layanan/');
                    $data     = Layanan::getFilename($session_upload_id);
                    $filename = strtolower($data->nama_layanan).'.'.$model->file_image->extension;
                    $redirect = ['layanan/view', 'layanan_id' => $data->layanan_id];
                } elseif ($pathName === 'kategori-game') {
                    $path     = Yii::getAlias('@common/uploads/kategori-game/');
                    $data     = KategoriGame::getFilename($session_upload_id);
                    $filename = strtolower($data->kategori_game).'.'.$model->file_image->extension;
                    $redirect = ['kategori-game/view', 'id' => $data->id];
                }
                
                if (!$model->file_image->saveAs($path.$filename)) {
                    Yii::error(['msg' => 'Gagal Menyimpan Gambar', 'errors' => $model->errors], __METHOD__);
                }
                $update = FileUpload::findOne(['session_upload_id' => $session_upload_id]);
                if ($update) {
                    $update->session_upload_id = $session_upload_id;
                    $update->file_name         = $filename;
                    $update->update();
                } else {
                    $model->session_upload_id = $session_upload_id;
                    $model->file_name         = $filename;
                    $model->created_by        = Yii::$app->user->identity->id;
                    $model->save(false);
                }
                
                return $this->redirect($redirect);
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing FileUpload model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $session_upload_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($session_upload_id)
    {
        $model = $this->findModel($session_upload_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FileUpload model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $session_upload_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($session_upload_id)
    {
        $this->findModel($session_upload_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FileUpload model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $session_upload_id
     * @return FileUpload the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($session_upload_id)
    {
        if (($model = FileUpload::findOne($session_upload_id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
