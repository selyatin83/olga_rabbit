<?php

declare(strict_types=1);

namespace app\widgets;

use yii\base\Widget;

class VkButtonWidget extends Widget
{
    public function run()
    {
        return $this->render('vkButtonWidget');
    }
}