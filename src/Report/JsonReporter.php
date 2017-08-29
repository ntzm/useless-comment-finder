<?php

namespace Ntzm\UselessCommentFinder\Report;

use Ntzm\UselessCommentFinder\Violation;

final class JsonReporter implements Reporter
{
    public function generate(Summary $summary): string
    {
        return json_encode([
            'stats' => [
                'time' => $summary->getTimeInMilliseconds(),
                'memory' => $summary->getMemoryInBytes(),
            ],
            'violations' => array_map(function (Violation $violation) {
                return [
                    'file' => $violation->getFile()->getRealPath(),
                    'line' => $violation->getComment()->getLine(),
                ];
            }, $summary->getViolations()),
        ], JSON_PRETTY_PRINT);
    }
}
