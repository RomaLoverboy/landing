<?php

namespace romaloverboy\partner\controllers;

use Yii;
use romaloverboy\partner\models\Logo;
use romaloverboy\partner\models\search\LogoSearch;
use vendor\landing\partner\models\Photo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
/**
 * LogoController implements the CRUD actions for Logo model.
 */
class LogoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['switch'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['Superadmin'],
                    ],
                ],
            ],
        ];
    }
    public function actions()
    {
    return [
        'uploadPhoto' => [
            'class' => 'budyaga\cropper\actions\UploadAction',
            'url' => 'http://Project/admin/partner/images/Logo',
            'path' => '/partner/images/Logo',
        ]
    ];
    }
    /**
     * Lists all Logo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LogoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Logo model.
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
     * Creates a new Logo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Logo();
        $path_one = 'partner/images/Logo/preview/';
		$path_two = 'images/Logo/preview/';
        if ($model->load(Yii::$app->request->post())) {

            $uploadedFile = UploadedFile::getInstance($model, 'img');

            if ($uploadedFile !== null) {
                $path = 'images/Logo/'
                    . Yii::$app->security->generateRandomString()
                    . '.' . $uploadedFile->extension;
                
                if ($model->validate()) {
                    $model->upload($path);
					
                    $uploadedFile->saveAs('partner/' . $path);
					$model->savePreview($path, $path_one, $path_two);
                }
            }
            if ($model->save()) {
              
               return $this->redirect(['view', 'id' => $model->id]);

            }
        }            

        return $this->render('create', [
            'model' => $model
            ]);
    }

    /**
     * Updates an existing Contacts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $path_one = 'partner/images/Logo/preview/';
		$path_two = 'images/Logo/preview/';
        if ($model->load(Yii::$app->request->post())) {

            $uploadedFile = UploadedFile::getInstance($model, 'img');

            if ($uploadedFile !== null) {
                $path = 'images/Logo/'
                    . Yii::$app->security->generateRandomString()
                    . '.' . $uploadedFile->extension;
                
                if ($model->validate()) {
                    $model->upload($path);
					
                    $uploadedFile->saveAs('partner/' . $path);
					$model->savePreview($path, $path_one, $path_two);
                }
            }	
		 if($model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Logo model.
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
     * Finds the Logo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Logo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
	
	public function getPhoto()
    {
        return $this->hasMany(Photo::className(),
            [
                'object_id' => 'id',
                'type' => 'avatar_label',
            ])->andWhere(['deleted' => 0]);
    }
	
    protected function findModel($id)
    {
        if (($model = Logo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
