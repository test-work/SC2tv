<?php

class Page extends CActiveRecord{
	public function tableName(){
		return '{{page}}';
	}

	public function rules(){
		return array(
			array('title, text', 'required'),
			array('title', 'length', 'max'=>50),
            array('text', 'length', 'max'=>200),
			array('id, title, text', 'safe', 'on'=>'search'),
		);
	}

	public function relations(){
		return array(
		);
	}

	public function attributeLabels(){
		return array(
			'id' => 'ID',
			'title' => 'Заголовок',
			'text' => 'Текст',
		);
	}

	public function search(){
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}
}
