<?php

class PageController extends Controller
{
	//print_r($_POST);exit();
    
    public $layout='//layouts/column2';

	public function filters(){
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules(){
		return array(
			array('allow',
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id){
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate(){
		$model=new Page;
		if(isset($_POST['Page'])){
		      $_POST['Page']['user'] = Yii::app()->user->id;
			$model->attributes=$_POST['Page'];
			 if($model->save()){
                    
//update sp1
$zapros = " SELECT * FROM `o_page` ORDER BY `id` DESC LIMIT 0,1";
$arr = Page::model()->findBySql($zapros);
//print_r($arr);

Yii::app()->db
->createCommand("UPDATE `o_page` SET `user`='".(Yii::app()->user->id)."' WHERE `id`='".$arr->id."'")
->execute();
//update sp1
                    
                //$this->render('page',array('create'=>$model,));
                $this->redirect(array('create','id'=>$model->id));
                //$this->redirect(array('reg','id'=>$model->id));
            }
		}
		$this->render('create',array('model'=>$model,));
	}

	public function actionUpdate($id){
		$model=$this->loadModel($id);
		if(isset($_POST['Page'])){
			$model->attributes=$_POST['Page'];
			if($model->save()){
				$this->redirect(array('view','id'=>$model->id));
            }
		}
		$this->render('update',array('model'=>$model,));
	}

	public function actionDelete($id){
		$this->loadModel($id)->delete();
		if(!isset($_GET['ajax'])){
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
	}

	public function actionIndex(){
		$dataProvider=new CActiveDataProvider('Page');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin(){
		$model=new Page('search');
		$model->unsetAttributes();
		if(isset($_GET['Page'])){
			$model->attributes=$_GET['Page'];
        }
		$this->render('admin',array('model'=>$model,));
	}

	public function loadModel($id){
		$model=Page::model()->findByPk($id);
		if($model===null){
			throw new CHttpException(404,'The requested page does not exist.');
        }
		return $model;
	}

	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='page-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
