<?php
declare(strict_types = 1);

namespace TildBJ\Tco;

/**
 * Class File
 *
 * @package TildBJ\Tco
 */
final class File
{
    use Common\CanBeExcluded;

    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $fieldName
     */
    private $fieldName;

    /**
     * @var int $maxitems
     */
    private $maxitems = null;

    /**
     * @param string $label
     * @param string $fieldName
     */
    public function __construct(string $label, string $fieldName)
    {
        $this->label = $label;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $tca = [
            'exclude' => $this->exclude,
            'label' => $this->label,
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                $this->fieldName,
                [
                    'foreign_types' => array(
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
                            'showitem' =>
                                '--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette,
                              --palette--;;imageoverlayPalette,
                              --palette--;;filePalette'
                        ),
                    ),
                    'maxitems' => $this->maxitems,
                    'overrideChildTca' => [
                        'types' => [
                            5 => [
                                'showitem' => 'title, --palette--;;filePalette'
                            ]
                        ]
                    ],
                ],
                'pdf'
            )
        ];

        return $tca;
    }

    /**
     * @param int $max
     * @return File
     */
    public function setMaxItems(int $max) : self
    {
        $this->maxitems = $max;

        return $this;
    }
}
