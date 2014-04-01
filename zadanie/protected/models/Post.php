<?php

class Post extends CActiveRecord
{
	const STATUS_DRAFT=1;
	const STATUS_PUBLISHED=2;
	const STATUS_ARCHIVED=3;

	private $_oldTags;

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return '{{post}}';
	}

	public function rules(){
		return array(
			array('title, content, status', 'required'),
			//array('status', 'in', 'range'=>array(1,2,3)),
			array('title', 'length', 'max'=>128),
			array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
			array('tags', 'normalizeTags'),

			array('title, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations(){
		return array(
			'author' => array(self::BELONGS_TO, 'User', 'author_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'post_id', 'condition'=>'comments.status='.Comment::STATUS_APPROVED, 'order'=>'comments.create_time DESC'),
			'commentCount' => array(self::STAT, 'Comment', 'post_id', 'condition'=>'status='.Comment::STATUS_APPROVED),
		);
	}

	public function attributeLabels(){
		return array(
			'id' => 'Id',
			'title' => 'Title',
			'content' => 'Content',
			'tags' => 'Tags',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'author_id' => 'Author',
		);
	}

	public function getUrl(){
		return Yii::app()->createUrl('post/view', array(
			'id'=>$this->id,
			'title'=>$this->title,
		));
	}

	public function getTagLinks(){
		$links=array();
		foreach(Tag::string2array($this->tags) as $tag){
			$links[]=CHtml::link(CHtml::encode($tag), array('post/index', 'tag'=>$tag));}
		return $links;
	}

	public function normalizeTags($attribute,$params){
		$this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
	}

	public function addComment($comment){
		if(Yii::app()->params['commentNeedApproval']){$comment->status=Comment::STATUS_PENDING;}
		else{$comment->status=Comment::STATUS_APPROVED;}
		$comment->post_id=$this->id;
		return $comment->save();
	}

	protected function afterFind(){
		parent::afterFind();
		$this->_oldTags=$this->tags;
	}

	protected function beforeSave(){
		if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->create_time=$this->update_time=time();
				$this->author_id=Yii::app()->user->id;
			}else{$this->update_time=time();}
			return true;
		}else{return false;}
	}

	protected function afterSave(){
		parent::afterSave();
		Tag::model()->updateFrequency($this->_oldTags, $this->tags);
	}

	protected function afterDelete(){
		parent::afterDelete();
		Comment::model()->deleteAll('post_id='.$this->id);
		Tag::model()->updateFrequency($this->tags, '');
	}

	public function search(){
		$criteria=new CDbCriteria;

		$criteria->compare('title',$this->title,true);

		$criteria->compare('status',$this->status);

		return new CActiveDataProvider('Post', array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'status, update_time DESC',
			),
		));
	}
}