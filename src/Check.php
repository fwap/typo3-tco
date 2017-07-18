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
    use Common\CanBeExcluded;

    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $type
     */
    private $type = 'check';

    /**
     * @var array $items
     */
    private $items = [];

    /**
     * @var int
     */
    private $cols = 1;

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
                'cols' => $this->cols,
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

    /**
     * @param int $cols
     * @return Check
     */
    public function setCols(int $cols): self
    {
        $this->cols = $cols;

        return $this;
    }

    /**
     * @return Check
     */
    public function floatCheckboxes(): self
    {
        $this->cols = 'inline';

        return $this;
    }
}
