<?php

declare(strict_types=1);

namespace omarinina\application\factories\ad\interfaces;

use omarinina\application\factories\ad\dto\NewCommentDto;
use omarinina\domain\models\ads\Comments;

interface CommentFactoryInterface
{
    public function createNewComment(NewCommentDto $dto): Comments;
}