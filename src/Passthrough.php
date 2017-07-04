<?php
declare(strict_types = 1);

namespace TildBJ\Tco;

/**
 * Class Passthrough
 *
 * @package TildBJ\Tco
 */
final class Passthrough
{
    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $type
     */
    private $type = 'passthrough';

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
            'config' => [
                'type' => $this->type,
            ],
        ];

        return $tca;
    }
}
