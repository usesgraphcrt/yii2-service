<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use pistol88\service\models\Category;

$categories = Category::find()->where("id != :id AND (parent_id = 0 OR parent_id IS NULL)", [':id' => (int)$model->id])->all();
$categories = ArrayHelper::map($categories, 'id', 'name');
$categories['0'] = 'Нет';
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
        <?php echo $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>

        <p><small>Чем выше приоритет, тем выше элемент среди других в общем списке.</small></p>
    
        <?= $form->field($model, 'parent_id')->dropdownList($categories);?>
    
        
        <?=\pistol88\gallery\widgets\Gallery::widget(['model' => $model]); ?>
        <br />
    
        <div class="form-group">
            <?php echo Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
