<?php

use yii\grid\GridView;

?>

<h1> <?=$ladder->title;?></h1>

<?php

echo GridView::widget([
    'summary' => '',
    'options' => ['class' => 'table-responsive'],
    'dataProvider' => $dataProvider,
    'columns' => [
        'player.nickname',
        'mmr',
        'apm',
        'games_count',
        'victories',
//      TODO: можно сделать вот так 'winPercent:percent', но там корявый визуал почему-то
        [
            'attribute' => 'winPercent',
            'class' => 'yii\grid\DataColumn',
            'value' => function ($data) {
                return $data->winPercent . '%';
            },
        ],
        [
            'attribute' => 'race',
            'class' => 'yii\grid\DataColumn',
            'value' => function ($data) {
                return $data->race->title;
            },
        ],
    ],
]);