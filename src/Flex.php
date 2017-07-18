<?php
declare(strict_types = 1);

namespace TildBJ\Tco;

/**
 * Class Flex
 *
 * @package TildBJ\Tco
 */
final class Flex
{
    use Common\CanBeExcluded;

    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $type
     */
    private $type = 'flex';

    /**
     * @var string $defaultFlexform
     */
    private $defaultFlexform = '';

    /**
     * @param $label
     */
    public function __construct(string $label)
    {
        $this->label = $label;
    }

    /**
     * @param string $defaultFlexform
     * @return Flex
     */
    public function setDefaultFlexform(string $defaultFlexform): self
    {
        $this->defaultFlexform = $defaultFlexform;

        return $this;
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
                'ds' => [
                    'default' => $this->defaultFlexform,
                ]
            ],
        ];

        return $tca;
    }
}
