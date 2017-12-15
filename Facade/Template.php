<?php

namespace PRECAST\Facade;

use PRECAST\Facade\Contract\AbstractFacade;
use PRECAST\Facade\Contract\FacadeOption;
use PRECAST\Vendor\Factory\Contract\TemplateInterface;

/**
 * Class Template
 * @package PRECAST\Facade
 */
class Template extends AbstractFacade
{
    /**
     * @param FacadeOption|null $FacadeOption
     * @return TemplateInterface
     */
    public static function Package(FacadeOption $FacadeOption = null): TemplateInterface
    {
        $Adapter = null;

        if ($FacadeOption) {
            switch ($FacadeOption->getOption('File')) {
                case 'twig': {
                    $Adapter = null;
                    break;
                }
                default: {
                    $Adapter = null;
                    break;
                }
            }
        }

        return (new \PRECAST\Vendor\Factory\Package\Template(
            $Adapter
        ))->getPackage();
    }

}
