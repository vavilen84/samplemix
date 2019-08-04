<?php
namespace app\controllers;

use yii\helpers\Json;
use Yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use Yii;
use yii\web\Response;

class AjaxController extends BaseController
{
    public function behaviors()
    {
        return [];
    }

    public function actionAddSampleToCollection()
    {
        $sampleId = Yii::$app->request->post('sampleId');
        $collectionId = Yii::$app->request->post('collectionId');
        $collection = Yii::$app->base->getCollection($collectionId);
        $sample = Yii::$app->base->getSample($sampleId);
        if (!empty($collection) && !empty($sample)) {
            if (!empty($collection->json)) {
                $json = Json::decode($collection->json);
                if (is_array($json) && !in_array($sampleId, $json)) {
                    $json[] = $sampleId;
                    $collection->json = Json::encode(array_unique($json));
                    $collection->save(false);
                }
            } else {
                $collection->json = Json::encode([$sampleId]);
                $collection->save(false);
            }
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [];
    }

    public function actionRemoveSampleFromCollection()
    {
        $sampleId = Yii::$app->request->post('sampleId');
        $collectionId = Yii::$app->request->post('collectionId');
        $collection = Yii::$app->base->getCollection($collectionId);
        $sample = Yii::$app->base->getSample($sampleId);
        if (!empty($collection) && !empty($sample)) {
            if (!empty($collection->json)) {
                $json = Json::decode($collection->json);
                if (is_array($json)) {
                    if (($key = array_search($sampleId, $json)) !== false) {
                        unset($json[$key]);
                    }
                    $collection->json = !empty($json) ? Json::encode($json) : null;
                    $collection->save(false);
                }
            }
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [];
    }

    public function actionSetCollection()
    {
        $samples = null;
        $collectionId = Yii::$app->request->post('collectionId');
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'samples' => Yii::$app->base->getChunkedCollectionSamples($collectionId)
        ];
    }
}
