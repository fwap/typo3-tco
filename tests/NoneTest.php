<?php
declare(strict_types = 1);

namespace TildBJ\Tco\Test;

use TildBJ\Tco\None;

final class NoneTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function defaultTypeIsNone()
    {
        $tca = (new None('foobar'))->toArray();
        $this->assertSame('none', $tca['config']['type']);
    }

    /**
     * @test
     */
    public function labelAndGivenKeyMatches()
    {
        $tca = (new None('foobar'))->toArray();
        $this->assertSame('foobar', $tca['label']);
    }

    /**
     * @test
     */
    public function excludeCanBeDisabled()
    {
        $tco = (new None('foobar'))->exclude(false);
        $tca = $tco->toArray();
        $this->assertSame(0, $tca['exclude']);

        $tco->exclude();
        $tca = $tco->toArray();
        $this->assertSame(1, $tca['exclude']);
    }
}
