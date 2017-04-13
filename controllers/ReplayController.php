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

class ReplayController extends Controller
{
    public function actionReplays($id = null) {
        if (!is_numeric($id) && $id != 'all')
            throw new NotFoundHttpException();
        $games = ($id != 'all') ? Games::getTypeGames($id) : Games::getGames();

        return $this->render('replays', [
            'games' => $games
        ]);
    }

}