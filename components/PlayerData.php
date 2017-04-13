<?php
namespace app\components;

use app\models\Game;
use app\models\Ladder;
use app\models\Player;
use app\models\Race;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

class PlayerData {
//    public $gamesWithId;
    public $id;
    public $racesWithId;
    public $laddersWithId;
    public $playerModel;
    public $gamesWithId;

    public function __construct($id = null)
    {
        if ($id != null) {
            $this->id = $id;
            // TODO:
            // тут можно сделать более хитрый join и избавиться от запроса ниже, но запрос будет более навороченный
            $this->playerModel = Player::find()
                ->joinWith('gamePlayers', true)
                ->joinWith('games', true)
                ->joinWith('ladderStats', true)
                ->where(['players.id' => $id])
                ->one();

            $this->laddersWithId = $this->getLadders($this->playerModel);
            $this->racesWithId = $this->getRaces();
            $this->gamesWithId = $this->getGames($this->playerModel);
        }
    }


    public function getGamesDataProvider() {
        
    }

    public function playerTotals() {
        $raceCounters = [];
        $totalGames = $totalWins = $apm = 0;
        foreach ($this->playerModel->gamePlayers as $key => $game) {
            $totalGames += 1;
            $totalWins += ($game->winner) ? 1 : 0;
            $apm += $game->apm;
            if (!isset($raceCounters[$game->race_id]))
                $raceCounters[$game->race_id] = ['total' => 0, 'wins' => 0];
            $raceCounters[$game->race_id]['total'] += 1;
            $raceCounters[$game->race_id]['wins'] += ($game->winner) ? 1 : 0;
        }
        return [
            'totalGames' => $totalGames,
            'totalWins' => $totalWins,
            'totalLosses' => $totalGames - $totalWins,
            'winPercent' => $totalWins / $totalGames * 100,
            'apm' => $apm / $totalGames,
            'favouriteRace' => array_search(max($raceCounters), $raceCounters),
            'raceCounters' => $raceCounters
        ];
    }

    public function getLaddersDataProvider() {
        $dataProvider = new ArrayDataProvider([
            'allModels' => $this->playerModel->ladderStats,
//            'sort'=> [
//                'defaultOrder' => [
//                    'id'=>SORT_ASC
//                ]
//            ],
            'pagination' => false
        ]);

        return $dataProvider;
    }

    public function getChartsData() {
        $gamePlayers = $this->playerModel->gamePlayers;

        $data = [
            'mmr' => [],
            'apm' => [],
            'games' => [],
        ];
        $resultData = [
            'MMR' => [],
            'diffMMR' => [],
            'APM' => [],
            'gamesCount' => [],
            'gamesCountDaily' => []
        ];
        usort($gamePlayers, [get_called_class(), 'sortGamesByDate']);

        // TODO: намудрил, можно СИЛЬНО проще
        // например, я группирую их сначала по параметру, а потом по дате
        // если сделать наоборот, это уменьшит количество кода

        foreach ($gamePlayers as $key => $gameStat) {
            $gameDate = date('Y-m-d', strtotime($this->gamesWithId[$gameStat->game_id]->date));
            // mmr
            if (!isset($data['mmr'][$gameDate]))
                $data['mmr'][$gameDate] = ['diff' => 0, 'initial' => $gameStat->mmr_initial, 'total' => $gameStat->mmr_initial];
            $data['mmr'][$gameDate]['diff'] += $gameStat->mmr_diff;
            $data['mmr'][$gameDate]['total'] += $gameStat->mmr_diff;
            // apm
            if (!isset($data['apm'][$gameDate]))
                $data['apm'][$gameDate] = 0;
            $data['apm'][$gameDate] += $gameStat->apm;
            // count
            if (!isset($data['games'][$gameDate]))
                $data['games'][$gameDate] = 0;
            $data['games'][$gameDate] += 1;
        }

        foreach ($data['mmr'] as $date => $dataArray) {
            $resultData['MMR'][$date] = $dataArray['total'];
            $resultData['diffMMR'][$date] = $dataArray['diff'];
        }
        $init = 0;
        foreach ($data['games'] as $date => $count) {
            $resultData['gamesCount'][$date] = $count + $init;
            $resultData['gamesCountDaily'][$date] = $count;
            $init += $count;
        }
        foreach ($data['apm'] as $date => $apm) {
            $resultData['APM'][$date] = $apm / $resultData['gamesCountDaily'][$date];
        }

        return $resultData;
    }

    private static function sortGamesByDate($a, $b) {
        return strtotime($a->date) - strtotime($b->date);
    }


    private function getLadders($model) {
        $laddersWithIds = [];
        $ladderIds = array_map(function($model) {
            return $model->ladder_id;
        }, $model->ladderStats);

        $ladders = Ladder::findAll(['id' => $ladderIds]);

        foreach ($ladders as $key => $value) {
            $laddersWithIds[$value->id] = $value;
        }
        return $laddersWithIds;
    }

    private function getRaces() {
        $racesWithIds = [];
        $races = Race::find()->all();
        foreach ($races as $key => $value) {
            $racesWithIds[$value->id] = $value;
        }
        return $racesWithIds;
    }

    private function getGames($model) {
        $gamesWithIds = [];
        foreach ($model->games as $key => $value) {
            $gamesWithIds[$value->id] = $value;
        }
        return $gamesWithIds;
    }
}