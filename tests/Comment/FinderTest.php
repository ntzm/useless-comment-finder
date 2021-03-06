<?php

namespace Ntzm\Tests\PhpUcf\Comment;

use Ntzm\PhpUcf\Comment\Finder;
use PHPUnit\Framework\TestCase;

final class FinderTest extends TestCase
{
    /**
     * @param array  $expected
     * @param string $input
     *
     * @dataProvider provideCommentedCode
     */
    public function testFindComments(array $expected, string $input): void
    {
        $finder = new Finder();

        $this->assertSame($expected, array_column($finder->find($input), 1));
    }

    public function provideCommentedCode(): array
    {
        return [
            [
                [
                    "// This is a comment\n",
                    '/* This is another comment */',
                    '/** This is the final comment */',
                ],
                '<?php

                // This is a comment
                echo "foo // bar";

                echo \'foo // bar\';
                /* This is another comment */
               	/** This is the final comment */
                ',
            ],
            [
                [],
                '<?php

                echo "hi";
                ',
            ],
        ];
    }
}
