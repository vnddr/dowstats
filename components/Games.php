<?php
namespace app\components;

use app\models\Game;
use app\models\Race;

class Games {

    public static function getPlayerGames($id, $limit = 20, $offset = 0) {
        $gamesArray = self::getGameQuery($limit, $offset)
            ->where(['player_id' => $id])
            ->all();

        return self::processGamesArray($gamesArray);
    }

    public static function getTypeGames($id, $limit = 50, $offset = 0) {
        $gamesArray = self::getGameQuery($limit, $offset)
            ->where(['games.type' => $id])
            ->all();

        return self::processGamesArray($gamesArray);
    }

    public static function getGames($limit = 50, $offset = 0) {
        $gamesArray = self::getGameQuery($limit, $offset)
            ->all();

        return self::processGamesArray($gamesArray);
    }

    protected static function processGamesArray($gamesArray) {
        $gamesData = [];
        $races = self::getRaces();
        foreach ($gamesArray as $key => $value) {
            $playersData = [];
            foreach ($value->players as $k => $v) {
                $playersData[$v->id] = $v->attributes;
            }
            $gamesData[$value->id] = $value->attributes;
            $gamesData[$value->id]['map_img'] = $value->mapmodel->image;
            $gamesData[$value->id]['map'] = $value->mapmodel->title;
            $gamesData[$value->id]['players'] = [
                'winners' => [],
                'losers' => []
            ];
            foreach ($value->gamePlayers as $k => $playerStats) {
                $tempGamePlayer = [
                    'playerId' => $playerStats->player_id,
                    'apm' => $playerStats->apm,
                    'mmr_initial' => $playerStats->mmr_initial,
                    'mmr_diff' => $playerStats->mmr_diff,
                    'race' => $races[$playerStats->race_id],
                    'nickname' => $playersData[$playerStats->player_id]['nickname'],
                ];
                if ($playerStats->winner) {
                    $gamesData[$value->id]['players']['winners'][] = $tempGamePlayer;
                } else {
                    $gamesData[$value->id]['players']['losers'][] = $tempGamePlayer;
                }
            }
        }
        return $gamesData;
    }

    protected static function getGameQuery($limit, $offset) {
        return Game::find()
            ->joinWith('gamePlayers', true)
            ->joinWith('players', true)
            ->joinWith('mapmodel', true)
            ->orderBy('date DESC')
            ->limit($limit)
            ->offset($offset);
    }

    protected static function getRaces() {
        $racesWithIds = [];
        $races = Race::find()->all();
        foreach ($races as $key => $value) {
            $racesWithIds[$value->id] = $value;
        }
        return $racesWithIds;
    }
}