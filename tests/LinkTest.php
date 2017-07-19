<?php
declare(strict_types = 1);

namespace TildBJ\Tco\Test;

use TildBJ\Tco\Link;

final class LinkTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function defaultTypeIsInput()
    {
        $tca = (new Link('foobar'))->toArray();
        $this->assertSame('input', $tca['config']['type']);
    }

    /**
     * @test
     */
    public function renderTypeIsInputLink()
    {
        $tca = (new Link('foobar'))->toArray();
        $this->assertSame('inputLink', $tca['config']['renderType']);
    }

    /**
     * @test
     */
    public function labelAndGivenKeyMatches()
    {
        $tca = (new Link('foobar'))->toArray();
        $this->assertSame('foobar', $tca['label']);
    }

    /**
     * @test
     */
    public function enableAndDisableLinkOptions()
    {
        $tco = (new Link('foobar'));
        $this->assertTrue(in_array('url', $this->getBlindLinkOptions($tco)));
        $this->assertTrue(in_array('mail', $this->getBlindLinkOptions($tco)));
        $this->assertTrue(in_array('file', $this->getBlindLinkOptions($tco)));
        $this->assertTrue(in_array('folder', $this->getBlindLinkOptions($tco)));

        $tco->enableUrl();
        $this->assertFalse(in_array('url', $this->getBlindLinkOptions($tco)));

        $tco->enableMail();
        $this->assertFalse(in_array('mail', $this->getBlindLinkOptions($tco)));

        $tco->enableFile();
        $this->assertFalse(in_array('file', $this->getBlindLinkOptions($tco)));

        $tco->enableFolder();
        $this->assertFalse(in_array('folder', $this->getBlindLinkOptions($tco)));

        $tco->disablePage();
        $this->assertTrue(in_array('page', $this->getBlindLinkOptions($tco)));
    }

    /**
     * @test
     */
    public function enableAndDisableLinkFields()
    {
        $tco = (new Link('foobar'));
        $this->assertTrue(in_array('class', $this->getBlindLinkFields($tco)));
        $this->assertTrue(in_array('params', $this->getBlindLinkFields($tco)));
        $this->assertTrue(in_array('target', $this->getBlindLinkFields($tco)));
        $this->assertTrue(in_array('title', $this->getBlindLinkFields($tco)));

        $tco->enableClass();
        $this->assertFalse(in_array('class', $this->getBlindLinkOptions($tco)));

        $tco->enableParams();
        $this->assertFalse(in_array('params', $this->getBlindLinkOptions($tco)));

        $tco->enableTarget();
        $this->assertFalse(in_array('target', $this->getBlindLinkOptions($tco)));

        $tco->enableTitle();
        $this->assertFalse(in_array('title', $this->getBlindLinkOptions($tco)));
    }

    /**
     * @test
     */
    public function excludeCanBeDisabled()
    {
        $tco = (new Link('foobar'))->exclude(false);
        $tca = $tco->toArray();
        $this->assertSame(0, $tca['exclude']);

        $tco->exclude();
        $tca = $tco->toArray();
        $this->assertSame(1, $tca['exclude']);
    }

    /**
     * @param Link $tco
     * @return array
     */
    protected function getBlindLinkOptions(Link $tco): array
    {
        $tca = $tco->toArray();
        return explode(',', $tca['config']['fieldControl']['linkPopup']['options']['blindLinkOptions']);
    }

    /**
     * @param Link $tco
     * @return array
     */
    protected function getBlindLinkFields(Link $tco): array
    {
        $tca = $tco->toArray();
        return explode(',', $tca['config']['fieldControl']['linkPopup']['options']['blindLinkFields']);
    }
}
