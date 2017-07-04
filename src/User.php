<?php
declare(strict_types = 1);

namespace TildBJ\Tco;

/**
 * Class User
 *
 * @package TildBJ\Tco
 */
final class User
{
    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $type
     */
    private $type = 'user';

    /**
     * @var string
     */
    private $userFunc = '';

    /**
     * @var array
     */
    private $parameters = [];

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
                'userFunc' => $this->userFunc,
                'parameters' => $this->parameters,
            ],
        ];

        return $tca;
    }

    /**
     * @param string $key
     * @param $value
     * @return User
     */
    public function addParameter(string $key, $value): self
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    /**
     * @param string $userFunc
     * @return User
     */
    public function setUserFunc(string $userFunc): self
    {
        $this->userFunc = $userFunc;

        return $this;
    }
}
