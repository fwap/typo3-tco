<?php
declare(strict_types = 1);

namespace TildBJ\Tco\Test;

use TildBJ\Tco\Text;

final class TextTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function defaultTypeIsText()
    {
        $tca = (new Text('foobar'))->toArray();
        $this->assertSame('text', $tca['config']['type']);
    }

    /**
     * @test
     */
    public function labelAndGivenKeyMatches()
    {
        $tca = (new Text('foobar'))->toArray();
        $this->assertSame('foobar', $tca['label']);
    }

    /**
     * @test
     */
    public function requiredCanBeSet()
    {
        $tco = (new Text('foobar'))->isRequired(true);
        $tca = $tco->toArray();

        $eval = explode(',', $tca['config']['eval']);
        $this->assertTrue(in_array('required', $eval));

        $tco->isRequired(false);
        $tca = $tco->toArray();

        $eval = explode(',', $tca['config']['eval']);
        $this->assertFalse(in_array('required', $eval));
    }

    /**
     * @test
     */
    public function rteCanBeEnabled()
    {
        $tco = new Text('foobar');
        $tco->enableRte();

        $tca = $tco->toArray();

        $this->assertTrue($tca['config']['enableRichtext']);
    }

    /**
     * @test
     */
    public function enableRteWithParamSetsRteType()
    {
        $tco = new Text('foobar');
        $tco->enableRte('foobar');

        $tca = $tco->toArray();

        $this->assertSame('foobar', $tca['config']['richtextConfiguration']);
    }

    /**
     * @test
     */
    public function setSize()
    {
        $tca = (new Text('foobar'))
            ->setSize(50, 20)
            ->toArray();

        $this->assertSame(
            [50, 20],
            [$tca['config']['cols'], $tca['config']['rows']]
        );
    }
}
