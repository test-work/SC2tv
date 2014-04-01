<?php

class User extends CActiveRecord
{
	public $veryfine;
    
    public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return '{{user}}';
	}

	public function rules(){
		return array(
			array('username, password, email', 'required'),
			array('username, password, email', 'length', 'max'=>128),
			array('profile', 'safe'),
            //array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'reg'),
		);
	}

	public function relations(){
		return array(
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
		);
	}

	public function attributeLabels(){
		return array(
			'id' => 'Id',
			'username' => 'Имя',
			'password' => 'Пасс',
			'email' => 'Почта',
			'profile' => 'Профиль',
            'verifyCode' => 'Код',
		);
	}

	public function validatePassword($password){
		return CPasswordHelper::verifyPassword($password,$this->password);
	}

	public function hashPassword($password){
		return CPasswordHelper::hashPassword($password);
	}
}
