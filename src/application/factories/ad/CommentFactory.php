<?php

declare(strict_types=1);

namespace omarinina\application\factories\ad;

use omarinina\application\factories\ad\dto\NewCommentDto;
use omarinina\application\factories\ad\interfaces\CommentFactoryInterface;
use omarinina\domain\models\ads\Comments;
use yii\web\ServerErrorHttpException;

class CommentFactory implements CommentFactoryInterface
{
    /**
     * @param NewCommentDto $dto
     * @return Comments
     * @throws ServerErrorHttpException
     */
    public function createNewComment(NewCommentDto $dto): Comments
    {
        $newComment = new Comments();
        $newComment->author = $dto->author;
        $newComment->adId = $dto->adId;
        $newComment->text = $dto->form->text;

        if (!$newComment->save(false)) {
            throw new ServerErrorHttpException(
                'Your data has not been recorded, please try again later',
                500
            );
        }
        return $newComment;
    }
}