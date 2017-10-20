<?php

namespace Vendor\Bundle;

use Vendor\AdapterInterface;

/**
 * Interface SettingInterface
 * @package Vendor\Bundle
 */
interface SettingInterface extends AdapterInterface
{
    /**
     * @param string $FileLocation
     * @return SettingInterface
     */
    public function loadFile($FileLocation): SettingInterface;

    /**
     * @param string $FileLocation
     * @return SettingInterface
     */
    public function saveFile($FileLocation): SettingInterface;

    /**
     * @param string[] $Path
     * @return mixed
     */
    public function getValue(string ...$Path);

    /**
     * @param mixed $Value
     * @param string[] $Path
     * @return SettingInterface
     */
    public function setValue($Value, string ...$Path): SettingInterface;
}
