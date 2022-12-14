<?php

declare(strict_types=1);

namespace app\widgets;

use omarinina\domain\models\ads\Ads;
use yii\base\Widget;

class AdWidget extends Widget
{
    public Ads $ad;

    public function run()
    {
        return $this->render('adWidget', ['ad' => $this->ad]);
    }
}