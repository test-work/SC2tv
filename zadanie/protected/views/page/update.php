<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
	array('label'=>'View Page', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Manage Page', 'url'=>array('admin')),
    
);
?>



<?php
//echo '-Текущий-'.Yii::app()->user->id.'-';

$id = (int)$_GET['id'];//stripslashes//htmlspecialchars//mysql_real_escape_string//echo $user;
$user = Yii::app()->user->id;

$zapros = "SELECT `id` FROM `o_page` WHERE `id`='".$id."' AND `user`='".$user."'";//echo $zapros;
$arr = Page::model()->findAllBySql($zapros);
if(!empty($arr)){
    //echo '1';
    if($_GET['del']=='yes'){
        echo 'Производим удаление записи<br>';
        Yii::app()->db
        ->createCommand("UPDATE `o_page` SET `vis`='1' WHERE `id`='".$id."'")
        ->execute();
        ?>
        <h1>Твит удален!</h1>
        <?
    }else{
        ?>
        <h1>Обновить твит <?php echo $model->id; ?></h1>
        <?
        $this->renderPartial('_form', array('model'=>$model));        
    }
}else{
    //echo '0';
    echo 'Вы не можете править чужой твит!';
}


?>