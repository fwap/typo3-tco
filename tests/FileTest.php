<?php
declare(strict_types = 1);

namespace TildBJ\Tco\Test;

use TildBJ\Tco\File;

final class FileTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function labelAndGivenKeyMatches()
    {
        $tca = (new File('foobar'))->toArray();
        $this->assertSame('foobar', $tca['label']);
    }

    /**
     * @test
     */
    public function setMaxItems()
    {
        $tca = (new File('foobar'))->setMaxItems(7)->toArray();
        $this->assertSame(7, $tca['config']['maxitems']);
    }
}
