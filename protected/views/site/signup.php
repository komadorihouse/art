<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'SignUp',
);
?>

<h1>SignUp</h1>

<p>新規ユーザー登録</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'SignUpForm',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sait'); ?>
		<?php echo $form->textField($model,'sait'); ?>
		<?php echo $form->error($model,'sait'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profile'); ?>
		<?php echo $form->textArea($model,'profile'); ?>
		<?php echo $form->error($model,'profile'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<button class='button span-2 login' type="submit">登録</button>
		<a href='/index.php?r=site/index'>
			<div class='button span-4 signin'>もどる</div>
		</a>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
