<?php
/**
 * Created by PhpStorm.
 * User: d.gromov
 * Date: 11/04/17
 * Time: 12:12
 */

use yii\grid\GridView;
?>
<h1>Ladder Stats</h1>
<?php
echo GridView::widget([
    'summary' => '',
    'options' => ['class' => 'table-responsive'],
    'dataProvider' => $ladderDataProvider,
    'columns' => [
        [
            'attribute' => 'Ladder',
            'class' => 'yii\grid\DataColumn',
            'value' => function ($data) use ($ladders) {
                return $ladders[$data->ladder_id]->title;
            },
        ],
        'mmr',
        [
            'attribute' => 'Favourite race',
            'class' => 'yii\grid\DataColumn',
            'value' => function ($data) use ($races) {
                return $races[$data->fav_race_id]->title;
            },
        ],
        'games_count',
        'victories',
        [
            'attribute' => 'Win Percent',
            'class' => 'yii\grid\DataColumn',
            'value' => function ($data) {
                return $data->victories / $data->games_count * 100 . '%';
            },
        ],
        [
            'attribute' => 'APM',
            'class' => 'yii\grid\DataColumn',
            'value' => function ($data) {
                return $data->apm_total / $data->games_count;
            },
        ],
////      TODO: можно сделать вот так 'winPercent:percent', но там корявый визуал почему-то
//        [
//            'attribute' => 'winPercent',
//            'class' => 'yii\grid\DataColumn',
//            'value' => function ($data) {
//                return $data->winPercent . '%';
//            },
//        ],
//        [
//            'attribute' => 'race',
//            'class' => 'yii\grid\DataColumn',
//            'value' => function ($data) {
//                return $data->race->title;
//            },
//        ],
    ],
]);

?>

<div class="row">
    <div class="col-lg-4">
        <div id="mmrchart" class="player__chart"></div>
    </div>
    <div class="col-lg-4">
        <div id="mmrdiffchart" class="player__chart"></div>
    </div>
    <div class="col-lg-4">
        <div id="apmchart" class="player__chart"></div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div id="gameschart" class="player__chart"></div>
    </div>
    <div class="col-lg-4">
        <div id="gamesdailychart" class="player__chart"></div>
    </div>
</div>

<script>
    Highcharts.chart('mmrchart', {
        title: {
            text: 'MMR'
        },
//        subtitle: {
//            text: 'Source: thesolarfoundation.com'
//        },
        yAxis: {
            title: {
                text: ''
            }
        },
        xAxis: {
            categories: <?php echo json_encode(array_keys($chartsData['MMR']));?>
        },
//        legend: {
//            layout: 'vertical',
//            align: 'right',
//            verticalAlign: 'middle'
//        },

//        plotOptions: {
//            series: {
//                pointStart: 2010
//            }
//        },
        series: [{
            name: 'ELO points',
            data: <?php echo json_encode(array_values($chartsData['MMR']));?>
        }]

    });

    Highcharts.chart('mmrdiffchart', {
        title: {
            text: 'MMR diff'
        },
//        subtitle: {
//            text: 'Source: thesolarfoundation.com'
//        },
        yAxis: {
            title: {
                text: ''
            }
        },
        xAxis: {
            categories: <?php echo json_encode(array_keys($chartsData['diffMMR']));?>
        },
//        legend: {
//            layout: 'vertical',
//            align: 'right',
//            verticalAlign: 'middle'
//        },

//        plotOptions: {
//            series: {
//                pointStart: 2010
//            }
//        },
        series: [{
            name: 'ELO points',
            data: <?php echo json_encode(array_values($chartsData['diffMMR']));?>
        }]

    });

    Highcharts.chart('apmchart', {
        title: {
            text: 'APM'
        },
//        subtitle: {
//            text: 'Source: thesolarfoundation.com'
//        },
        yAxis: {
            title: {
                text: ''
            }
        },
        xAxis: {
            categories: <?php echo json_encode(array_keys($chartsData['APM']));?>
        },
//        legend: {
//            layout: 'vertical',
//            align: 'right',
//            verticalAlign: 'middle'
//        },

//        plotOptions: {
//            series: {
//                pointStart: 2010
//            }
//        },
        series: [{
            name: 'Actions per minute',
            data: <?php echo json_encode(array_values($chartsData['APM']));?>
        }]

    });

    Highcharts.chart('gameschart', {
        title: {
            text: 'Games Played'
        },
//        subtitle: {
//            text: 'Source: thesolarfoundation.com'
//        },
        yAxis: {
            title: {
                text: ''
            }
        },
        xAxis: {
            categories: <?php echo json_encode(array_keys($chartsData['gamesCount']));?>
        },
//        legend: {
//            layout: 'vertical',
//            align: 'right',
//            verticalAlign: 'middle'
//        },

//        plotOptions: {
//            series: {
//                pointStart: 2010
//            }
//        },
        series: [{
            name: 'Games Played',
            data: <?php echo json_encode(array_values($chartsData['gamesCount']));?>
        }]

    });

    Highcharts.chart('gamesdailychart', {
        title: {
            text: 'Games Played (Daily)'
        },
//        subtitle: {
//            text: 'Source: thesolarfoundation.com'
//        },
        yAxis: {
            title: {
                text: ''
            }
        },
        xAxis: {
            categories: <?php echo json_encode(array_keys($chartsData['gamesCountDaily']));?>
        },
//        legend: {
//            layout: 'vertical',
//            align: 'right',
//            verticalAlign: 'middle'
//        },

//        plotOptions: {
//            series: {
//                pointStart: 2010
//            }
//        },
        series: [{
            name: 'Games Played',
            data: <?php echo json_encode(array_values($chartsData['gamesCountDaily']));?>
        }]

    });
</script>