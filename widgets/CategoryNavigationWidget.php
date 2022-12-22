<?php

declare(strict_types=1);

namespace app\widgets;

use omarinina\domain\models\ads\AdCategories;
use yii\base\Widget;

class CategoryNavigationWidget extends Widget
{
    /** @var AdCategories[] $categories */
    public array $categories;

    public function run()
    {
        return $this->render('categoryNavigationWidget', ['categories' => $this->categories]);
    }
}