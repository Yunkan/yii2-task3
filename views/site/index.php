<div class="container">
    <? if(!Yii::$app->user->isGuest) : ?>
        <?= \yii\helpers\Html::a('Создать', ['/admin/request/create'], ['class' => 'btn btn-success']) ?>
    <? endIf; ?>

    <? foreach($requests as $request) : ?>
        <p><?= $request->id ?></p>
        <p><?= $request->name ?></p>
        <p><?= $request->type->name ?></p>
        <?= yii\helpers\Html::img($request->image, ['width' => 300]) ?>
    <? endForeach; ?>
</div>