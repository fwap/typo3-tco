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
     * @var string $label
     */
    private $label;

    /**
     * @var string $type
     */
    private $type = 'input';

    /**
     * @var string $eval
     */
    private $eval = 'trim,required';

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
