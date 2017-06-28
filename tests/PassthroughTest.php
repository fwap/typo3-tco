<?php
declare(strict_types = 1);

namespace TildBJ\Tco\Test;

use TildBJ\Tco\Passthrough;

final class PassthroughTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function defaultTypeIsPassthrough()
    {
        $tca = (new Passthrough('foobar'))->toArray();
        $this->assertSame('passthrough', $tca['config']['type']);
    }
}
