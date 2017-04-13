<?php

namespace app\controllers;

use app\models\Game;
use app\models\Ladder;
use app\models\LadderStats;
use app\models\Player;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class LadderController extends Controller
{

    /**
     * Экшен открытия странички ладдера
     * @param string $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionLadder($id)
    {
        $ladder = Ladder::find()->where(['url' => $id])->one();

        if (!$ladder) {
            throw new NotFoundHttpException('The requested ladder does not exist');
        }

        $exprApm = new Expression('apm_total / games_count AS apm');
        $exprPercent = new Expression('case when victories = 0 then 0 else games_count / victories * 100 end AS winPercent');

        $dataQuery = LadderStats::find()
            ->select(['*', $exprApm, $exprPercent])
            ->joinWith('player', true)
            ->joinWith('race', true)
            ->where(['ladder_id' => $ladder->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $dataQuery,
            'pagination' => [
                'pageSize' => 100,
            ],
            'sort'=> [
                'defaultOrder' => [
                    'mmr'=>SORT_DESC
                ]
            ]
        ]);

        $sort = $dataProvider->getSort();
        $sort->attributes = array_merge($sort->attributes, [
            'apm' => [
                'asc' => ['apm' => SORT_DESC],
                'desc' => ['apm' => SORT_ASC]
            ],
            'winPercent' => [
                'asc' => ['winPercent' => SORT_DESC],
                'desc' => ['winPercent' => SORT_ASC]
            ],
        ]);
        $dataProvider->setSort($sort);

        return $this->render('ladder', [
            'ladder' => $ladder,
            'dataProvider' => $dataProvider
        ]);
    }

}
