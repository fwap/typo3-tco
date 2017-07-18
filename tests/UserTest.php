<?php
declare(strict_types = 1);

namespace TildBJ\Tco\Test;

use TildBJ\Tco\User;

final class UserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function defaultTypeIsUser()
    {
        $tca = (new User('foobar'))->toArray();
        $this->assertSame('user', $tca['config']['type']);
    }

    /**
     * @test
     */
    public function labelAndGivenKeyMatches()
    {
        $tca = (new User('foobar'))->toArray();
        $this->assertSame('foobar', $tca['label']);
    }

    /**
     * @test
     */
    public function addParameter()
    {
        $tca = (new User('foobar'))
            ->addParameter('foo', 'bar')
            ->addParameter('foobar', ['foo', 'bar'])
            ->toArray();

        $this->assertSame(['foo' => 'bar', 'foobar' => ['foo', 'bar']], $tca['config']['parameters']);
    }

    /**
     * @test
     */
    public function setUserFunc()
    {
        $tca = (new User('foobar'))->setUserFunc('foobar')->toArray();
        $this->assertSame('foobar', $tca['config']['userFunc']);
    }

    /**
     * @test
     */
    public function excludeCanBeDisabled()
    {
        $tco = (new User('foobar'))->exclude(false);
        $tca = $tco->toArray();
        $this->assertSame(0, $tca['exclude']);

        $tco->exclude();
        $tca = $tco->toArray();
        $this->assertSame(1, $tca['exclude']);
    }
}
