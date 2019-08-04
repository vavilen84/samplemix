<?php
namespace app\components;

use Yii;
use yii\base\Component;
use app\models\db as Models;

class BaseComponentData extends Component
{
    const KEY_A = 1;
    const KEY_AM = 2;
    const KEY_B = 3;
    const KEY_BM = 4;
    const KEY_H = 5;
    const KEY_HM = 6;
    const KEY_C = 7;
    const KEY_CM = 8;
    const KEY_C_SHARP = 9;
    const KEY_CM_SHARP = 10;
    const KEY_D = 11;
    const KEY_DM = 12;
    const KEY_D_SHARP = 13;
    const KEY_DM_SHARP = 14;
    const KEY_E = 15;
    const KEY_EM = 16;
    const KEY_F = 17;
    const KEY_FM = 18;
    const KEY_F_SHARP = 19;
    const KEY_FM_SHARP = 20;
    const KEY_G = 21;
    const KEY_GM = 22;
    const KEY_G_SHARP = 23;
    const KEY_GM_SHARP = 24;

    const TAG_PIANO = 1;
    const TAG_AMBIENT = 2;
    const TAG_TRANCE = 3;
    const TAG_GOA = 4;
    const TAG_ELECTRONIC = 5;

    protected $keys = [
        self::KEY_A => 'A',
        self::KEY_AM => 'Am',
        self::KEY_B => 'B',
        self::KEY_BM => 'Bm',
        self::KEY_H => 'H',
        self::KEY_HM => 'Hm',
        self::KEY_C => 'C',
        self::KEY_CM => 'Cm',
        self::KEY_C_SHARP => 'C#',
        self::KEY_CM_SHARP => 'Cm#',
        self::KEY_D => 'D',
        self::KEY_DM => 'Dm',
        self::KEY_D_SHARP => 'D#',
        self::KEY_DM_SHARP => 'Dm#',
        self::KEY_E => 'E',
        self::KEY_EM => 'Em',
        self::KEY_F => 'F',
        self::KEY_FM => 'Fm',
        self::KEY_F_SHARP => 'F#',
        self::KEY_FM_SHARP => 'Fm#',
        self::KEY_G => 'G',
        self::KEY_GM => 'Gm',
        self::KEY_G_SHARP => 'G#',
        self::KEY_GM_SHARP => 'Gm#',
    ];

    protected $tags = [
        self::TAG_PIANO => 'Piano',
        self::TAG_AMBIENT => 'Ambient',
        self::TAG_TRANCE => 'Trance',
        self::TAG_GOA => 'Goa',
        self::TAG_ELECTRONIC => 'Electronic'
    ];
}