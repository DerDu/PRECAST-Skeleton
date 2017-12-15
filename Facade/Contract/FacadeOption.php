<?php

namespace PRECAST\Facade\Contract;

/**
 * Class FacadeOption
 * @package PRECAST\Facade\Contract
 */
class FacadeOption
{
    /** @var array $Options */
    private $Options = [];

    /**
     * FacadeOption constructor.
     * @param array|null $Options
     */
    public function __construct(array $Options = null)
    {
        if (null !== $Options) {
            $this->setOptions($Options);
        }
    }

    /**
     * @param array $Options
     * @return FacadeOption
     */
    private function setOptions(array $Options): FacadeOption
    {
        $this->Options = $Options;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->Options;
    }

    /**
     * @param string $Key
     * @param mixed $Value
     * @return FacadeOption
     */
    public function setOption($Key, $Value): FacadeOption
    {
        $this->Options[$Key] = $Value;
        return $this;
    }

    /**
     * @param string $Key
     * @param null|mixed $Default
     * @return mixed|null
     */
    public function getOption($Key, $Default = null)
    {
        if (isset($this->Options[$Key])) {
            return $this->Options[$Key];
        }
        return $Default;
    }
}
