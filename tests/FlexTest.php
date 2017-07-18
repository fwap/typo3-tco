<?php
declare(strict_types = 1);

namespace TildBJ\Tco\Test;

use TildBJ\Tco\Flex;

final class FlexTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function defaultTypeIsFlex()
    {
        $tca = (new Flex('foobar'))->toArray();
        $this->assertSame('flex', $tca['config']['type']);
    }

    /**
     * @test
     */
    public function labelAndGivenKeyMatches()
    {
        $tca = (new Flex('foobar'))->toArray();
        $this->assertSame('foobar', $tca['label']);
    }

    /**
     * @test
     */
    public function setDefaultFlexform()
    {
        $tca = (new Flex('foobar'))->setDefaultFlexform('foobar')->toArray();
        $this->assertSame('foobar', $tca['config']['ds']['default']);
    }

    /**
     * @test
     */
    public function excludeCanBeDisabled()
    {
        $tco = (new Flex('foobar'))->exclude(false);
        $tca = $tco->toArray();
        $this->assertSame(0, $tca['exclude']);

        $tco->exclude();
        $tca = $tco->toArray();
        $this->assertSame(1, $tca['exclude']);
    }
}
