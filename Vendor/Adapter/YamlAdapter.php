<?php

namespace Vendor\Adapter;

use Symfony\Component\Yaml\Yaml;
use Vendor\AbstractAdapter;
use Vendor\AdapterInterface;
use Vendor\Bundle\SettingInterface;

/**
 * Class YamlAdapter
 * @package Vendor\Adapter
 */
class YamlAdapter extends AbstractAdapter implements SettingInterface
{

    /**
     * @return AdapterInterface
     */
    public function createAdapter(): AdapterInterface
    {
        print __METHOD__ . PHP_EOL;
        return $this;
    }

    /**
     * @param string $FileLocation
     * @return SettingInterface
     */
    public function loadFile($FileLocation): SettingInterface
    {
        print __METHOD__ . PHP_EOL;
        $this->setRawVendor(
            Yaml::parse(file_get_contents($FileLocation))
        );
        return $this;
    }

    /**
     * @param mixed $Value
     * @param string[] $Path
     * @return SettingInterface
     */
    public function setValue($Value, string ...$Path): SettingInterface
    {
        print __METHOD__ . PHP_EOL;
        $Vendor = $this->getRawVendor();
        $this->array_set_value($Vendor, $Path, $Value);
        $this->setRawVendor($Vendor);
        return $this;
    }

    /**
     * @param array $array
     * @param array|string $parents
     * @param mixed $value
     * @param string $glue
     */
    private function array_set_value(array &$array, $parents, $value, $glue = '.')
    {
        if (!is_array($parents)) {
            $parents = explode($glue, (string)$parents);
        }

        $ref = &$array;

        foreach ($parents as $parent) {
            if (isset($ref) && !is_array($ref)) {
                $ref = [];
            }

            $ref = &$ref[$parent];
        }

        $ref = $value;
    }

    /**
     * @param string[] $Path
     * @return mixed
     */
    public function getValue(string ...$Path)
    {
        print __METHOD__ . PHP_EOL;
        $Path = func_get_args();
        $Vendor = $this->getRawVendor();
        return $this->array_get_value($Vendor, $Path);
    }

    /**
     * @param array $array
     * @param array|string $parents
     * @param string $glue
     * @return mixed
     */
    private function array_get_value(array &$array, $parents, $glue = '.')
    {
        if (!is_array($parents)) {
            $parents = explode($glue, $parents);
        }

        $ref = &$array;

        foreach ((array)$parents as $parent) {
            if (is_array($ref) && array_key_exists($parent, $ref)) {
                $ref = &$ref[$parent];
            } else {
                return null;
            }
        }
        return $ref;
    }

    /**
     * @param string $FileLocation
     * @return SettingInterface
     */
    public function saveFile($FileLocation): SettingInterface
    {
        print __METHOD__ . PHP_EOL;
        file_put_contents($FileLocation, Yaml::dump($this->getRawVendor()));
        return $this;
    }

    /**
     * @param array $array
     * @param array|string $parents
     * @param string $glue
     */
    private function array_unset_value(&$array, $parents, $glue = '.')
    {
        if (!is_array($parents)) {
            $parents = explode($glue, $parents);
        }

        $key = array_shift($parents);

        if (empty($parents)) {
            unset($array[$key]);
        } else {
            $this->array_unset_value($array[$key], $parents);
        }
    }
}
