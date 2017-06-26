<?php
declare(strict_types = 1);

namespace TildBJ\Tco\Test;

use TildBJ\Tco\Inline;

final class InlineTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function defaultTypeIsInline()
    {
        $tca = (new Inline('foo', 'bar', 'foofoo', 'barbar'))->toArray();
        $this->assertSame('inline', $tca['config']['type']);
    }

    /**
     * @test
     */
    public function labelAndGivenKeyMatches()
    {
        $tca = (new Inline('foo', 'bar', 'foofoo', 'barbar'))->toArray();
        $this->assertSame('foo', $tca['label']);
    }

    /**
     * @test
     */
    public function setDefaults()
    {
        $tca = (new Inline('foo', 'bar', 'foofoo', 'barbar'))->toArray();
        $this->assertSame('bar', $tca['config']['foreign_table']);
        $this->assertSame('foofoo', $tca['config']['foreign_field']);
        $this->assertSame('barbar', $tca['config']['foreign_table_field']);
    }

    /**
     * @test
     */
    public function setMaxItems()
    {
        $tca = (new Inline('foo', 'bar', 'foofoo', 'barbar'))->setMaxItems(7)->toArray();
        $this->assertSame(7, $tca['config']['maxitems']);
    }
}
