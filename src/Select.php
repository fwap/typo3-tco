<?php
declare(strict_types = 1);

namespace TildBJ\Tco;

/**
 * Class Select
 *
 * @package TildBJ\Tco
 */
final class Select
{
    /**
     * @var string $key
     */
    private $key;

    /**
     * @var string $type
     */
    private $type = 'select';

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
     * @param string $image
     * @return $this
     */
    public function addItem($label, $value = null, string $image = null)
    {
        if (is_null($value)) {
            $value = $label;
        }
        array_push($this->items, [$label, $value, $image]);

        return $this;
    }
}
