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
     * @var string $key
     */
    private $key;

    /**
     * @var string $type
     */
    private $type = 'passthrough';

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
            'config' => [
                'type' => $this->type,
            ],
        ];

        return $tca;
    }
}
