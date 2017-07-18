<?php
declare(strict_types = 1);

namespace TildBJ\Tco;

/**
 * Class Text
 *
 * @package TildBJ\Tco
 */
final class Text
{
    use Common\CanBeExcluded;

    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $type
     */
    private $type = 'text';

    /**
     * @var int $cols
     */
    protected $cols = 30;

    /**
     * @var int $rows
     */
    protected $rows = 5;

    /**
     * @var string $eval
     */
    private $eval = 'trim,required';

    /**
     * @var bool $enableRichtext
     */
    private $enableRichtext = false;

    /**
     * @var string $ritchtextConfiguration
     */
    private $ritchtextConfiguration = 'default';

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
                'cols' => $this->cols,
                'rows' => $this->rows,
                'eval' => $this->eval,
                'enableRichtext' => $this->enableRichtext,
                'richtextConfiguration' => $this->ritchtextConfiguration,
            ],
        ];

        return $tca;
    }

    /**
     * @param string $ritchtextConfiguration
     * @return Text
     */
    public function enableRte(string $ritchtextConfiguration = null): self
    {
        $this->enableRichtext = true;
        if (!is_null($ritchtextConfiguration)) {
            $this->ritchtextConfiguration = $ritchtextConfiguration;
        }

        return $this;
    }

    /**
     * @param bool $setToRequired
     * @return Text
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

    /**
     * @param int $cols
     * @param int $rows
     * @return Text
     */
    public function setSize(int $cols = null, int $rows = null): self
    {
        if (!is_null($cols)) {
            $this->cols = $cols;
        }

        if (!is_null($rows)) {
            $this->rows = $rows;
        }

        return $this;
    }
}
