<?php
declare(strict_types = 1);

namespace TildBJ\Tco;

/**
 * Class Image
 *
 * @package TildBJ\Tco
 */
final class Image
{
    /**
     * @var string $key
     */
    private $key;

    /**
     * @var int $maxitems
     */
    private $maxitems = null;

    /**
     * @param $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $tca = [
            'exclude' => 1,
            'label' => $this->key,
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                $this->key,
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'maxitems' => $this->maxitems,
                    'overrideChildTca' => [
                        'types' => [
                            2 => [
                                'showitem' => 'title, alternative, --palette--;;filePalette'
                            ]
                        ]
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
    public function setMaxItems(int $max) : self
    {
        $this->maxitems = $max;

        return $this;
    }
}
