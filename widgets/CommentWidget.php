<?php

declare(strict_types=1);

namespace app\widgets;

use omarinina\domain\models\ads\Comments;
use yii\base\Widget;

class CommentWidget extends Widget
{
    public Comments $comment;

    public function run()
    {
        return $this->render('commentWidget', ['comment' => $this->comment]);
    }
}