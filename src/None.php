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
     * @var string $key
     */
    private $key;

    /**
     * @var string $type
     */
    private $type = 'none';

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
            ],
        ];

        return $tca;
    }
}
