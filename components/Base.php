<?php
namespace app\components;

use app\components\BaseComponentaData;
use Yii;
use yii\base\Component;
use app\models\db as Models;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class Base extends BaseComponentData
{
    const COLLECTION_ITEMS_COLUMN_COUNT = 5;
    const RANDOM_COLLECTION_SAMPLES_LIMIT = 50;

    public function getKeys()
    {
        return $this->keys;
    }

    public function getKeyTitle($key)
    {
        return $this->keys[trim($key)] ?? '';
    }

    public function getTagsList()
    {
        return $this->tags;
    }

    public function getDividedTags($tags)
    {
        $result = [];
        if (!empty($tags)) {
            $exploded = explode(',', $tags);
            foreach ($exploded as $tag) {
                if (!empty($this->tags[$tag])) {
                    $result[] = $this->getTagTitle($tag);
                }
            }
        }
        if (!empty($result)) {
            $result = implode(', ', $result);
        }
        $result = !empty($result) ? $result : '';

        return $result;
    }

    public function getTagTitle($key)
    {
        return $this->tags[$key] ?? '';
    }

    public function getRandomCssColor()
    {
        $result = '';
        for ($i = 0; $i < 3; $i++) {
            $result .= str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
        }

        return $result;
    }

    public function getMp3Url($id)
    {
        return '/samples/mp3/' . $id . '.mp3';
    }

    public function getWavUrl($id)
    {
        return '/samples/wav/' . $id . '.wav';
    }

    public function getUserNickname($userId)
    {
        $user = Models\User::findIdentity($userId);
        return $user ? $user->nickname : '';
    }

    public function getUserCollectionsList()
    {
        return ArrayHelper::map(Models\Collection::findAll(['user_id' => Yii::$app->user->id]), 'id', 'title');
    }

    public function getCollection($id)
    {
        return Models\Collection::findOne($id);
    }

    public function getSample($id)
    {
        return Models\Sample::findOne($id);
    }

    public function getCollectionSamples($collectionId)
    {
        $collection = Yii::$app->base->getCollection($collectionId);
        if (!empty($collection)) {
            if (!empty($collection->json)) {
                $json = Json::decode($collection->json);
                if (is_array($json)) {
                    return Models\Sample::findAll(['id' => $json]);
                }
            }
        }
    }

    public function getChunkedCollectionSamples($collectionId)
    {
        $result = $this->getCollectionSamples($collectionId);
        if (empty($result)) {
            $result = Models\Sample::find()->limit(self::RANDOM_COLLECTION_SAMPLES_LIMIT)->all();
        }
        if (!empty($result)) {
            $result = array_chunk($result, self::COLLECTION_ITEMS_COLUMN_COUNT);
        }

        return $result;
    }
}
