<?php
declare(strict_types=1);

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

    /**
     * @test
     */
    public function enableCropping()
    {
        $tco = (new Image('foobar'))->enableCropping();
        $tca = $tco->toArray();

        $items = explode(',', $tca['config']['overrideChildTca']['types'][2]['showitem']);
        $this->assertTrue(in_array('crop', $items));
    }

    /**
     * @test
     */
    public function disableDefaultCropVariant()
    {
        $tco = (new Image('foobar'));
        $tca = $tco->toArray();
        $this->assertFalse(
            $tca['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default']['disabled']
        );

        $tco->disableDefaultCropVariant();
        $tca = $tco->toArray();
        $this->assertTrue(
            $tca['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default']['disabled']
        );
    }

    /**
     * @test
     */
    public function addCropVariant()
    {
        $tca = (new Image('foobar'))
            ->addCropVariant('foo', 'Foo', 1920, 1080)
            ->addCropVariant('bar', 'Bar', 1024, 768)
            ->toArray();

        $expected = [
            'default' => [
                'disabled' => false,
            ],
            'foo' => [
                'title' => 'Foo',
                'allowedAspectRatios' => [
                    '1920:1080' => [
                        'title' => '1920 x 1080',
                        'value' => 1920 / 1080
                    ],
                ],
            ],
            'bar' => [
                'title' => 'Bar',
                'allowedAspectRatios' => [
                    '1024:768' => [
                        'title' => '1024 x 768',
                        'value' => 1024 / 768
                    ],
                ],
            ],
        ];
        $this->assertSame($expected, $tca['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']);
    }
}
