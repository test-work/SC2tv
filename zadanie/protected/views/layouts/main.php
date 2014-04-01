<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<title>♥ <?php echo CHtml::encode($this->pageTitle); ?> ♥</title>
</head>
<body>
<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				//array('label'=>'[ О нас ]', 'url'=>array('site/page', 'view'=>'about')),
				//array('label'=>'[ Контакты ]', 'url'=>array('page/index')),
                array('label'=>'[ Главная ]', 'url'=>array('post/index', 'user'=>''.Yii::app()->user->name.'')),
                array('label'=>'[ Личная ]', 'url'=>array('page/index'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'[ Создать ]', 'url'=>array('page/create')),
				array('label'=>'[ Войти ]', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'[ Регистрация ]', 'url'=>array('site/reg'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'[ '.Yii::app()->user->name.', выйти ]', 'url'=>array('site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>

	<div id="footer">
		Тестовое задание для СК 2 ТВ<br />
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>