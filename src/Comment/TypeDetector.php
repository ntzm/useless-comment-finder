<?php

namespace Ntzm\PhpUcf\Comment;

final class TypeDetector
{
    public function detect(string $comment): int
    {
        if (strpos($comment, '//') === 0) {
            return Comment::TYPE_SINGLE_LINE;
        }

        if (preg_match('/^\/\*\*\s/', $comment)) {
            return Comment::TYPE_DOC;
        }

        if (strpos($comment, '/*') === 0) {
            return Comment::TYPE_MULTI_LINE;
        }

        throw new InvalidCommentException();
    }
}
