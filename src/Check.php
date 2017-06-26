<?php
declare(strict_types = 1);

namespace TildBJ\Tco;

/**
 * Class Check
 *
 * @package TildBJ\Tco
 */
final class Check
{
    /**
     * @var string $key
     */
    private $key;

    /**
     * @var string $type
     */
    private $type = 'check';

    /**
     * @var array $items
     */
    private $items = [];

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
            'config' => [
                'type' => $this->type,
                'items' => $this->items,
            ],
        ];

        return $tca;
    }

    /**
     * @param $label
     * @param $value
     * @return $this
     */
    public function addItem($label, $value = null)
    {
        if (is_null($value)) {
            $value = $label;
        }
        array_push($this->items, [$label, $value]);

        return $this;
    }
}