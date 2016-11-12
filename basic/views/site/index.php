<?php

/* @var $this yii\web\View */

$this->title = 'Main page';
?>

<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
?>

<div class="site-index">

    <div class="jumbotron">
        <h3>Использование Google Maps API</h3>
    </div>

    <div class="body-content">
<?php
session_start();
if (isset($_SESSION['__id']) ? $_SESSION['__id'] : 0 == 100) {;
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'point_n',
				['options' => ['class' => 'form-inline']]
				)->textInput(["style"=>"width:100px;"])->label('Координата N');?>
				
<?= $form->field($model, 'point_e',
				['template' => "<div style='float:left;'>{label} &nbsp;</div>\n{input}"]
				)->textInput(["style"=>"width:100px;"])->label('Координата E');?>
				
<?= $form->field($model, 'point_name')->textInput(["style"=>"width:500px;",])?> 
<br><br>
<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']);?>

<?php ActiveForm::end();?>
<?php } ?>
    </div>
</div>
