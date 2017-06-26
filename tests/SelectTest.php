<?php
declare(strict_types = 1);

namespace TildBJ\Tco\Test;

use TildBJ\Tco\Select;

final class SelectTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function defaultTypeIsSelect()
    {
        $tca = (new Select('foobar'))->toArray();
        $this->assertSame('select', $tca['config']['type']);
    }

    /**
     * @test
     */
    public function labelAndGivenKeyMatches()
    {
        $tca = (new Select('foobar'))->toArray();
        $this->assertSame('foobar', $tca['label']);
    }

    /**
     * @test
     */
    public function addItem()
    {
        $tca = (new Select('foo'))
            ->addItem('foo')
            ->toArray();
        $this->assertSame([['foo', 'foo', null]], $tca['config']['items']);

        $tca = (new Select('foo'))
            ->addItem('foo', 'bar')
            ->toArray();
        $this->assertSame([['foo', 'bar', null]], $tca['config']['items']);

        $tca = (new Select('foo'))
            ->addItem('foo', 'bar', 'foobar')
            ->toArray();
        $this->assertSame([['foo', 'bar', 'foobar']], $tca['config']['items']);
    }

    /**
     * @test
     */
    public function addMultipleItems()
    {
        $expected = [
            ['foo', 0, null],
            ['foo', 'bar', null],
            ['foo', 1, 'pathToImage'],
        ];
        $tca = (new Select('foo'))
            ->addItem('foo', 0)
            ->addItem('foo', 'bar')
            ->addItem('foo', 1, 'pathToImage')
            ->toArray();
        $this->assertSame($expected, $tca['config']['items']);
    }
}
