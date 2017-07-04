<?php
declare(strict_types=1);

namespace TildBJ\Tco;

/**
 * Class Image
 *
 * @package TildBJ\Tco
 */
final class Image
{
    /**
     * @var string $label
     */
    private $label;

    /**
     * @var int $maxitems
     */
    private $maxitems = null;

    /**
     * @var array $cropVariants
     */
    private $cropVariants = [];

    /**
     * @var string $showItems
     */
    private $showItems = 'title,alternative';

    /**
     * @var string $filePalette
     */
    private $filePalette = '--palette--;;filePalette';

    /**
     * @var bool $disableDefaultCropVariant
     */
    private $disableDefaultCropVariant = false;

    /**
     * @param $label
     */
    public function __construct(string $label)
    {
        $this->label = $label;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $cropVariants['default'] = [
            'disabled' => $this->disableDefaultCropVariant
        ];
        foreach ($this->cropVariants as $key => $cropVariant) {
            $cropVariants[$key] = $cropVariant;
        }
        $tca = [
            'exclude' => 1,
            'label' => $this->label,
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                $this->label,
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'maxitems' => $this->maxitems,
                    'overrideChildTca' => [
                        'columns' => [
                            'crop' => [
                                'config' => [
                                    'cropVariants' => $cropVariants,
                                ],
                            ],
                        ],
                        'types' => [
                            2 => [
                                'showitem' => $this->showItems . ',' . $this->filePalette,
                            ],
                        ],
                    ],
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            )
        ];

        return $tca;
    }

    /**
     * @param int $max
     * @return Image
     */
    public function setMaxItems(int $max): self
    {
        $this->maxitems = $max;

        return $this;
    }

    /**
     * @return Image
     */
    public function enableCropping(): self
    {
        $items = explode(',', $this->showItems);
        if (!in_array('--linebreak--,crop', $items)) {
            $items[] = '--linebreak--,crop';
        }

        $this->showItems = implode(',', $items);

        return $this;
    }

    /**
     * @return Image
     */
    public function enableLink(): self
    {
        $items = explode(',', $this->showItems);
        if (!in_array('link', $items)) {
            $items[] = 'link';
        }

        $this->showItems = implode(',', $items);

        return $this;
    }

    /**
     * @param string $key
     * @param string $label
     * @param int $x
     * @param int $y
     * @return Image
     */
    public function addCropVariant(string $key, string $label, int $x, int $y): self
    {
        $this->cropVariants[$key] = [
            'title' => $label,
            'allowedAspectRatios' => [
                $x . ':' . $y => [
                    'title' => $x . ' x ' . $y,
                    'value' => $x / $y
                ]
            ],
        ];

        return $this;
    }

    /**
     * @return Image
     */
    public function disableDefaultCropVariant(): self
    {
        $this->disableDefaultCropVariant = true;

        return $this;
    }
}
