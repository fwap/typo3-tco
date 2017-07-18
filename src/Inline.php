<?php
declare(strict_types = 1);

namespace TildBJ\Tco;

/**
 * Class Inline
 *
 * @package TildBJ\Tco
 */
final class Inline
{
    use Common\CanBeExcluded;

    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $type
     */
    private $type = 'inline';

    /**
     * @var string $foreignTable
     */
    private $foreignTable = '';

    /**
     * @var string $foreignField
     */
    private $foreignField = '';

    /**
     * @var string $foreignTableField
     */
    private $foreignTableField = '';

    /**
     * @var int $maxitems
     */
    private $maxitems = null;

    /**
     * Inline constructor.
     *
     * @param string $label
     * @param string $foreignTable
     * @param string $foreignField
     * @param string $foreignTableField
     */
    public function __construct(string $label, string $foreignTable, string $foreignField, string $foreignTableField = null)
    {
        $this->label = $label;
        $this->foreignTable = $foreignTable;
        $this->foreignField = $foreignField;
        $this->foreignTableField = $foreignTableField;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $tca = [
            'exclude' => $this->exclude,
            'label' => $this->label,
            'config' => [
                'type' => $this->type,
                'foreign_table' => $this->foreignTable,
                'foreign_field' => $this->foreignField,
                'foreign_table_field' => $this->foreignTableField,
                'maxitems' => $this->maxitems,
                'appearance' => [
                    'collapseAll' => 1,
                    'expandSingle' => 1,
                ],
            ],
        ];

        return $tca;
    }

    /**
     * @param int $max
     * @return Inline
     */
    public function setMaxItems(int $max) : self
    {
        $this->maxitems = $max;

        return $this;
    }
}
