<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use pistol88\service\models\Service;
use kartik\select2\Select2;

$services = Service::find()->where("parent_id = 0 OR parent_id IS NULL")->all();
$services = ArrayHelper::map($services, 'id', 'name');
?>

<div class="complex-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'service_ids')
            ->widget(Select2::classname(), [
                'data' => $services,
                'language' => 'ru',
                'options' => ['multiple' => true, 'placeholder' => 'Выберите услуги комплекса ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
    
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>