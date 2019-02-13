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
        $tca = (new Image('foo', 'bar'))->toArray();
        $this->assertSame('foo', $tca['label']);
        $this->assertSame('bar', $tca['config']['foreign_match_fields']['fieldname']);
    }

    /**
     * @test
     */
    public function setMaxItems()
    {
        $tca = (new Image('foobar', 'foobar'))->setMaxItems(7)->toArray();
        $this->assertSame(7, $tca['config']['maxitems']);
    }

    /**
     * @test
     */
    public function setMinItems()
    {
        $tca = (new Image('foobar', 'foobar'))->setMinItems(1)->toArray();
        $this->assertSame(1, $tca['config']['minitems']);
    }

    /**
     * @test
     */
    public function enableCropping()
    {
        $tco = (new Image('foobar', 'foobar'))->enableCropping();
        $tca = $tco->toArray();

        $items = explode(',', $tca['config']['overrideChildTca']['types'][2]['showitem']);
        $this->assertTrue(in_array('crop', $items));
    }

    /**
     * @test
     */
    public function addCropVariant()
    {
        $tca = (new Image('foobar', 'foobar'))
            ->addCropVariant('foo', 'Foo', 1920, 1080)
            ->addCropVariant('bar', 'Bar', 1024, 768)
            ->toArray();

        $foo = [
            'title' => 'Foo',
            'allowedAspectRatios' => [
                '1920:1080' => [
                    'title' => '1920 x 1080',
                    'value' => 1920 / 1080
                ],
            ],
        ];
        $bar = [
            'title' => 'Bar',
            'allowedAspectRatios' => [
                '1024:768' => [
                    'title' => '1024 x 768',
                    'value' => 1024 / 768
                ],
            ],
        ];
        $this->assertSame($foo, $tca['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['foo']);
        $this->assertSame($bar, $tca['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['bar']);
    }

    /**
     * @test
     */
    public function addCropVariantShouldDisableDefaultCropVariant()
    {
        $tca = (new Image('foobar', 'foobar'))
            ->addCropVariant('foo', 'Foo', 1920, 1080)
            ->toArray();

        $this->assertTrue($tca['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default']['disabled']);
    }

    /**
     * @test
     */
    public function enableCroppingShouldAddDefaultCropVariantWhenUserDoesNotAddCropVariant()
    {
        $tca = (new Image('foobar', 'foobar'))
            ->enableCropping()
            ->toArray();

        $this->assertTrue(is_array($tca['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default']['allowedAspectRatios']));
        $this->assertFalse($tca['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default']['disabled']);
    }

    /**
     * @test
     */
    public function enableLink()
    {
        $tco = (new Image('foobar', 'foobar'))->enableLink();
        $tca = $tco->toArray();

        $items = explode(',', $tca['config']['overrideChildTca']['types'][2]['showitem']);
        $this->assertTrue(in_array('link', $items));
    }

    /**
     * @test
     */
    public function excludeCanBeDisabled()
    {
        $tco = (new Image('foobar', 'foobar'))->exclude(false);
        $tca = $tco->toArray();
        $this->assertSame(0, $tca['exclude']);

        $tco->exclude();
        $tca = $tco->toArray();
        $this->assertSame(1, $tca['exclude']);
    }

    /**
     * @test
     */
    public function cropVariantsMustNotBeEmptyWhenCroppingIsEnabled()
    {
        $tco = (new Image('foobar', 'foobar'))
            ->enableCropping();
        $tca = $tco->toArray();
        $emptyCropVariant = [
            'default' =>[
                'disabled' => false
            ],
        ];
        $this->assertNotSame(
            $emptyCropVariant,
            $tca['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']
        );
    }
}
