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
    /**
     * @var string $key
     */
    private $key;

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
     * @param string $key
     * @param string $foreignTable
     * @param string $foreignField
     * @param string $foreignTableField
     */
    public function __construct(string $key, string $foreignTable, string $foreignField, string $foreignTableField = null)
    {
        $this->key = $key;
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
            'exclude' => 1,
            'label' => $this->key,
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
