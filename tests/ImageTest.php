<?php
declare(strict_types = 1);

namespace TildBJ\Tco\Test;

use TildBJ\Tco\Image;

final class ImageTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'] = 'png,gif,jpg,jpeg,svg,ico';
    }

    /**
     * @test
     */
    public function labelAndGivenKeyMatches()
    {
        $tca = (new Image('foobar'))->toArray();
        $this->assertSame('foobar', $tca['label']);
    }

    /**
     * @test
     */
    public function setMaxItems()
    {
        $tca = (new Image('foobar'))->setMaxItems(7)->toArray();
        $this->assertSame(7, $tca['config']['maxitems']);
    }
}
