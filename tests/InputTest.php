<?php
declare(strict_types = 1);

namespace TildBJ\Tco\Test;

use TildBJ\Tco\Input;

final class InputTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function defaultTypeIsInput()
    {
        $tca = (new Input('foobar'))->toArray();
        $this->assertSame('input', $tca['config']['type']);
    }

    /**
     * @test
     */
    public function labelAndGivenKeyMatches()
    {
        $tca = (new Input('foobar'))->toArray();
        $this->assertSame('foobar', $tca['label']);
    }

    /**
     * @test
     */
    public function requiredCanBeSet()
    {
        $tco = (new Input('foobar'))->isRequired(true);
        $tca = $tco->toArray();

        $eval = explode(',', $tca['config']['eval']);
        $this->assertTrue(in_array('required', $eval));

        $tco->isRequired(false);
        $tca = $tco->toArray();

        $eval = explode(',', $tca['config']['eval']);
        $this->assertFalse(in_array('required', $eval));
    }
}
