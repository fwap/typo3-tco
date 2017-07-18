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
    use Common\CanBeExcluded;

    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $type
     */
    private $type = 'select';

    /**
     * @var array $items
     */
    private $items = [];

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
        $tca = [
            'exclude' => $this->exclude,
            'label' => $this->label,
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
