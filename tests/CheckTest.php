<?php
declare(strict_types = 1);

namespace TildBJ\Tco\Test;

use TildBJ\Tco\Check;

final class CheckTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function defaultTypeIsCheck()
    {
        $tca = (new Check('foobar'))->toArray();
        $this->assertSame('check', $tca['config']['type']);
    }

    /**
     * @test
     */
    public function labelAndGivenKeyMatches()
    {
        $tca = (new Check('foobar'))->toArray();
        $this->assertSame('foobar', $tca['label']);
    }

    /**
     * @test
     */
    public function addSingleItem()
    {
        $tca = (new Check('foo'))
            ->addItem('foo')
            ->toArray();
        $this->assertSame([['foo', 'foo']], $tca['config']['items']);

        $tca = (new Check('foo'))
            ->addItem('foo', 'bar')
            ->toArray();
        $this->assertSame([['foo', 'bar']], $tca['config']['items']);
    }

    /**
     * @test
     */
    public function addMultipleItems()
    {
        $expected = [
            ['foo', 0],
            ['foo', 'bar'],
        ];
        $tca = (new Check('foo'))
            ->addItem('foo', 0)
            ->addItem('foo', 'bar')
            ->toArray();
        $this->assertSame($expected, $tca['config']['items']);
    }

    /**
     * @test
     */
    public function setCols()
    {
        $tca = (new Check('foo'))->setCols(3)->toArray();
        $this->assertSame(3, $tca['config']['cols']);
    }

    /**
     * @test
     */
    public function floatCheckboxes()
    {
        $tca = (new Check('foo'))->floatCheckboxes()->toArray();
        $this->assertSame('inline', $tca['config']['cols']);
    }

    /**
     * @test
     */
    public function excludeCanBeDisabled()
    {
        $tco = (new Check('foo'))->exclude(false);
        $tca = $tco->toArray();
        $this->assertSame(0, $tca['exclude']);

        $tco->exclude();
        $tca = $tco->toArray();
        $this->assertSame(1, $tca['exclude']);
    }
}
