<?php
declare(strict_types = 1);

namespace TildBJ\Tco;

/**
 * Class None
 *
 * @package TildBJ\Tco
 */
final class None
{
    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $type
     */
    private $type = 'none';

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
            'exclude' => 1,
            'label' => $this->label,
            'config' => [
                'type' => $this->type,
            ],
        ];

        return $tca;
    }
}
