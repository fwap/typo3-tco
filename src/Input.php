<?php
declare(strict_types = 1);

namespace TildBJ\Tco;

/**
 * Class Input
 *
 * @package TildBJ\Tco
 */
final class Input
{
    /**
     * @var string $key
     */
    private $key;

    /**
     * @var string $type
     */
    private $type = 'input';

    /**
     * @var string $eval
     */
    private $eval = 'trim,required';

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
                'eval' => $this->eval,
            ],
        ];

        return $tca;
    }

    /**
     * @param bool $setToRequired
     * @return Input
     */
    public function isRequired(bool $setToRequired): self
    {
        $eval = explode(',', $this->eval);
        if ($setToRequired) {
            if (!in_array('required', $eval)) {
                $eval = 'required';
            }
        } else {
            foreach ($eval as $key => $value) {
                if (trim($value) === 'required') {
                    unset($eval[$key]);
                }
            }
        }

        $this->eval = implode(',', $eval);

        return $this;
    }
}
