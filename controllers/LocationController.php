<?php

namespace app\controllers;

use Yii;
use app\models\Location;
use app\models\LocationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LocationController implements the CRUD actions for Location model.
 */
class LocationController extends Controller
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
     * Lists all Location models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LocationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Location model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Location model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Location();

        if ($model->load(Yii::$app->request->post()))
        {
            date_default_timezone_set('Asia/Kolkata');
            $model->created_at = date('Y-m-d H:i');
            $model->save();
            return $this->redirect(['view', 'id' => $model->location_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Location model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->location_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Location model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Location model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Location the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Location::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

     public function actionCommon($attribute)
    {
        $imageFile = UploadedFile::getInstanceByName($attribute);
        $directory = \Yii::getAlias('@app/web/uploads') . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR;
        if ($imageFile) {

            $filetype = mime_content_type($imageFile->tempName);
            $allowed = array('image/png', 'image/jpeg', 'image/gif');
            //$allowed = array('gif', 'png', 'jpg', 'jpeg');
            if (!in_array(strtolower($filetype), $allowed)) {
                return json_encode(['files' => [
                    'error' => "File type not supported",
                ]
                ]);
            } else {
                $uid = uniqid(time(), true);
                $fileName = $uid . '.' . $imageFile->extension;
                $filePath = $directory . $fileName;
//                echo $filePath;
//                exit();
                if ($imageFile->saveAs($filePath)) {
                    $path = \yii\helpers\BaseUrl::home() . 'uploads/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;

//                    if ($imageFile->size >= 2097152) {
//
//                        list($width, $height) = getimagesize('uploads/' . $fileName);
//
//                        // $heightResize = 1150 * ($width / $height);
//
//                        $imageResize = Yii::$app->image->load('uploads/' . $fileName);
//                        $imageResize->resize(1200, 880);
//                        $imageResize->save();
//                    }

                    return json_encode([
                        'files' => [
                            'name' => $fileName,
                            //'size' => $imageFile->size,
                            "url" => $path,
                            "thumbnailUrl" => $path,
                            "deleteUrl" => 'image-delete?name=' . $fileName,
                            "deleteType" => "POST",
                            'error' => ""
                        ]
                    ]);
                }
            }
        }
        return '';
    }
}
