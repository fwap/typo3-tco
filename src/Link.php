<?php
declare(strict_types = 1);

namespace TildBJ\Tco;

/**
 * Class Link
 *
 * @package TildBJ\Tco
 */
final class Link
{
    use Common\CanBeExcluded;

    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $type
     */
    private $type = 'input';

    /**
     * @var string $blindLinkOptions
     */
    private $blindLinkOptions = 'url,mail,file,folder';

    /**
     * @var string $blindLinkFields
     */
    private $blindLinkFields = 'class,params,target,title';

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
                'fieldControl' => [
                    'linkPopup' => [
                        'options' => [
                            'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.link',
                            'blindLinkOptions' => $this->blindLinkOptions,
                            'blindLinkFields' => $this->blindLinkFields,
                        ]
                    ]
                ],
                'max' => 1024,
                'renderType' => 'inputLink',
                'size' => 20,
                'softref' => 'typolink',
            ]
        ];

        return $tca;
    }

    /**
     * @return Link
     */
    public function enableUrl(): self
    {
        $this->enableLinkOption('url');

        return $this;
    }

    /**
     * @return Link
     */
    public function enableMail(): self
    {
        $this->enableLinkOption('mail');

        return $this;
    }

    /**
     * @return Link
     */
    public function enableFile(): self
    {
        $this->enableLinkOption('file');

        return $this;
    }

    /**
     * @return Link
     */
    public function enableFolder(): self
    {
        $this->enableLinkOption('folder');

        return $this;
    }

    /**
     * @return Link
     */
    public function enableClass(): self
    {
        $this->enableLinkField('class');

        return $this;
    }

    /**
     * @return Link
     */
    public function enableParams(): self
    {
        $this->enableLinkField('class');

        return $this;
    }

    /**
     * @return Link
     */
    public function enableTarget(): self
    {
        $this->enableLinkField('target');

        return $this;
    }

    /**
     * @return Link
     */
    public function enableTitle(): self
    {
        $this->enableLinkField('title');

        return $this;
    }

    /**
     * @param $option
     */
    protected function enableLinkOption(string $option)
    {
        $blindLinkOptions = explode(',', $this->blindLinkOptions);

        foreach ($blindLinkOptions as $key => $value) {
            if (trim($value) === $option) {
                unset($blindLinkOptions[$key]);
            }
        }

        $this->blindLinkOptions = implode(',', $blindLinkOptions);
    }

    /**
     * @param $option
     */
    protected function enableLinkField(string $option)
    {
        $blindLinkFields = explode(',', $this->blindLinkFields);

        foreach ($blindLinkFields as $key => $value) {
            if (trim($value) === $option) {
                unset($blindLinkFields[$key]);
            }
        }

        $this->blindLinkFields = implode(',', $blindLinkFields);
    }

    /**
     * @return Link
     */
    public function disablePage(): self
    {
        $blindLinkOptions = explode(',', $this->blindLinkOptions);

        if (!in_array('page', $blindLinkOptions)) {
            $blindLinkOptions[] = 'page';
        }

        $this->blindLinkOptions = implode(',', $blindLinkOptions);

        return $this;
    }
}
