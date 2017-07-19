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
        $tca = (new File('foo', 'bar'))->toArray();
        $this->assertSame('foo', $tca['label']);
        $this->assertSame('bar', $tca['config']['foreign_match_fields']['fieldname']);
    }

    /**
     * @test
     */
    public function setMaxItems()
    {
        $tca = (new File('foobar', 'foobar'))->setMaxItems(7)->toArray();
        $this->assertSame(7, $tca['config']['maxitems']);
    }

    /**
     * @test
     */
    public function excludeCanBeDisabled()
    {
        $tco = (new File('foobar', 'foobar'))->exclude(false);
        $tca = $tco->toArray();
        $this->assertSame(0, $tca['exclude']);

        $tco->exclude();
        $tca = $tco->toArray();
        $this->assertSame(1, $tca['exclude']);
    }
}
