<?php
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Pictures';
$deleteUrl = \yii\helpers\Url::to('delete');
$rotateUrl = \yii\helpers\Url::to('rotate');
$this->registerJs(<<<JS
$(document).on('click', '.delete', function(){
    $.post('$deleteUrl', {
        picture:$(this).data('picture')
    },
    function(result) {
        if (result == 1) {
            window.location.reload();
        }
    });
});
$(document).on('click', '.rotate', function(){
    $.post('$rotateUrl', {
        picture:$(this).data('picture')
    },
    function(result) {
        if (result == 1) {
            window.location.reload();
        }
    });
});
JS
);
?>
<div class="site-index">

	<div class="jumbotron">
		<h1>Pictures</h1>
	</div>

	<div class="body-content">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
        <?= $form->field($model, 'imageFile')
            ->fileInput() ?>
		<button class="btn btn-success">Upload</button>
        <?php ActiveForm::end() ?>

		<div>
            <?php foreach ($uploaded as $picture) { ?>
				<div class="row">
					<div class="col-lg-5 col-md-5"><a
							href="/<?php echo Yii::$app->params['storage'] . '/' . Yii::$app->user->identity->storage
                                . '/' . $picture ?>" target="_blank"><img class="preview"
					                                                      src="/<?php echo Yii::$app->params['storage']
                                                                              . '/' . Yii::$app->user->identity->storage
                                                                              . '/' . $picture ?>"></a>
					</div>
					<div class="col-lg-2 col-md-2 rotate" data-picture="<?php echo $picture ?>">
						<button class="btn btn-primary">Rotate</button>
					</div>
					<div class="col-lg-2 col-md-2">
						<button class="btn btn-danger delete" data-picture="<?php echo $picture ?>">Delete</button>
					</div>
				</div>
            <?php } ?>
		</div>
	</div>
</div>
