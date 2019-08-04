<?php

namespace app\models\search;

use app\models\db as Models;
use yii\data\ActiveDataProvider;
use Yii;

class SampleSearch extends Models\Sample
{
    public $tags;
    public $sampleId;
    public $title;
    public $tempo;
    public $key;

    public function rules()
    {
        return [
            [['tags', 'sampleId', 'title', 'tempo', 'key'], 'safe'],
        ];
    }

    public function search($params)
    {
        $this->load($params);
        $query = Models\Sample::find();
        $query->andFilterWhere(['sample.id' => $this->sampleId]);
        $query->andFilterWhere(['like', 'sample.title', $this->title]);
        $query->andFilterWhere(['like', 'sample.tags', $this->tags]);
        $query->andFilterWhere(['sample.tempo' => $this->tempo]);
        $query->andFilterWhere(['sample.key' => $this->key]);
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $dataProvider->setSort(
            [
                'attributes' => [
                    'sampleId' => [
                        'asc' => ['sample.id' => SORT_ASC],
                        'desc' => ['sample.id' => SORT_DESC],
                        'label' => 'ID',
                        'default' => SORT_ASC
                    ],
                    'title' => [
                        'asc' => ['title' => SORT_ASC],
                        'desc' => ['title' => SORT_DESC],
                        'label' => 'Title',
                        'default' => SORT_ASC
                    ],
                    'tags' => [
                        'asc' => ['sample.tags' => SORT_ASC],
                        'desc' => ['sample.tags' => SORT_DESC],
                        'label' => 'Tags',
                        'default' => SORT_ASC
                    ],
                    'tempo' => [
                        'asc' => ['sample.tempo' => SORT_ASC],
                        'desc' => ['sample.tempo' => SORT_DESC],
                        'label' => 'Tempo',
                        'default' => SORT_ASC
                    ],
                    'key' => [
                        'asc' => ['sample.key' => SORT_ASC],
                        'desc' => ['sample.key' => SORT_DESC],
                        'label' => 'Key',
                        'default' => SORT_ASC
                    ],
                ]
            ]
        );

        if ($this->validate()) {
            return $dataProvider;
        }
    }
}
