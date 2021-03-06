<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>

<h1>Создать твит!</h1>

    <?php
        if(!empty($_GET['id'])){
            echo 'Ваш твит создан!<br><br>';
            
        }
    ?>

<?php
    //$this->renderPartial('_form', array('model'=>$model));
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'page-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <!--
    <div class="row">
        <?php echo $form->labelEx($model,'user'); ?>
        <?php echo $form->textField($model,'user'); ?>
        <?php echo $form->error($model,'user'); ?>
    </div>
    -->
    

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'text'); ?>
        <?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'text'); ?>
    </div>
    

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->