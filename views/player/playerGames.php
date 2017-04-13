<?php

use app\models\Race;

foreach ($games as $key => $value) {
    ?>
<div class="row map">
    <div class="col-lg-3">
        <div class="text-centered">
            <h3><?=$value['map'] . '  (' . $value['type'] * 2?>)</h3>
        </div>
        <div>
            <img class="map__picture img-rounded" src="<?=$value['map_img'] ?>">
        </div>
    </div>

    <div class="col-lg-7">
        <div class="row">
            <div class="col-md-6 map__playerpack">
                <table class="table" style="padding-right: 10px;">
                    <thead>
                    <tr>
                        <th style="text-align: center;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></th>
                        <th style="text-align: center;"><span class="glyphicon glyphicon-stats" aria-hidden="true"></th>
                        <th style="text-align: center;"><span class="glyphicon glyphicon-sort" aria-hidden="true"></th>
                        <th style="text-align: center;">APM</th>
                    </tr>
                    </thead>
                    <tbody>
<?php
    foreach ($value['players']['winners'] as $k => $v) {
?>
<tr>
    <td><img class="playericon" src="<?=Race::$icons[$v['race']->id]?>"><span><?=$v['nickname']?></span></td>
    <td><?=$v['mmr_initial']?></td>
    <td class="green"><?=$v['mmr_diff']?></td>
    <td><?=$v['apm']?></td>
</tr>
       <?php 
    }
?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 map__playerpack">
                <table class="table" style="padding-left: 10px">
                    <thead>
                    <tr>
                        <th style="text-align: center;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></th>
                        <th style="text-align: center;"><span class="glyphicon glyphicon-stats" aria-hidden="true"></th>
                        <th style="text-align: center;"><span class="glyphicon glyphicon-sort" aria-hidden="true"></th>
                        <th style="text-align: center;">APM</th>
                    </tr>
                    </thead>
                    <tbody>
<?php

foreach ($value['players']['losers'] as $k => $v) {
    ?>
    <tr>
        <td><img class="playericon" src="<?=Race::$icons[$v['race']->id]?>"><?=$v['nickname']?></td>
        <td><?=$v['mmr_initial']?></td>
        <td class="red"><?=$v['mmr_diff']?></td>
        <td><?=$v['apm']?></td>
    </tr>
    <?php
}

?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div>
            <div class="text-centered map__sidebar__toptext">
                Date: <?= date('Y-m-d', strtotime($value['date']))?>
            </div>
            <div class="text-centered map__sidebar__text">
                Downloads: <?= $value['downloads']?>
            </div>
            <div class="text-centered map__sidebar__text">
                <a href="<?= $value['replay_link']?>" class="btn btn-success" role="button">Download</a>
            </div>
            <div class="text-centered map__sidebar__text" style="padding-bottom: 10px">
                Game time: <?= $value['game_time']?>
            </div>
        </div>
    </div>
</div>
<?php


}