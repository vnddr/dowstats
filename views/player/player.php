<?php
//use app\assets\ChartsAsset;
//
//ChartsAsset::register($this);
use yii\bootstrap\Tabs;
?>

<div class="row">
    <div class="col-lg-3" style="width: 300px; float: left">

            <img class="player__avatar img-rounded" src="<?php echo $player->playerModel->avatar;?>">

    </div>
    <div class="col-lg-3 player__info">
        <div class="player__info__nickname">
            <?php echo $player->playerModel->nickname;?>
        </div>
        <div class="player__info__other">
            Steam ID: <?php echo $player->playerModel->sid;?>
        </div>
        <div class="player__info__other">
            Games total: <?php echo $playerTotals['totalGames'];?>
        </div>
        <div class="player__info__other">
            Games won: <?php echo $playerTotals['totalWins'];?>
        </div>
        <div class="player__info__other">
            Win percent: <?php echo $playerTotals['winPercent'] . '%';?>
        </div>
        <div class="player__info__other">
            APM: <?php echo $playerTotals['apm'];?>
        </div>
        <div class="player__info__other">
            Favourite race: <?php echo $races[$playerTotals['favouriteRace']]->title;?>
        </div>
    </div>
</div>

<div class="player-tabs">
<?php
//var_dump($player->attributes);
echo Tabs::widget([
    'items' => [
        [
            'label' => 'Player stats',
            'content' => $this->context->renderPartial('playerStats', [
                'ladderDataProvider' => $ladderDataProvider,
                'ladders' => $ladders,
                'races' => $races,
                'chartsData' => $chartsData
            ]),
            'active' => true
        ],
        [
            'label' => 'Last games',
            'content' => $this->context->renderPartial('playerGames', [
                'games' => $games
            ]),
        ],
    ],
]);
?>
</div>
