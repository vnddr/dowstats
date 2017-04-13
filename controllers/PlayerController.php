<?php

namespace app\controllers;

use app\components\Games;
use app\components\PlayerData;
use app\models\Game;
use app\models\Ladder;
use app\models\LadderStats;
use app\models\Race;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PlayerController extends Controller
{

    /**
     * Экшен открытия странички ладдера
     * @param string $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPlayer($id)
    {
        $player = new PlayerData($id);

        if (!$player->playerModel)
            throw new NotFoundHttpException();


        return $this->render('player', [
            'player' => $player,
            'ladders' => $player->laddersWithId,
            'races' => $player->racesWithId,
            'playerTotals' => $player->playerTotals(),
            'ladderDataProvider' => $player->getLaddersDataProvider(),
            'chartsData' => $player->getChartsData(),
            'games' => Games::getPlayerGames($id)
        ]);
    }
    
    public function ajaxPlayerGames() {
        
    }


}
