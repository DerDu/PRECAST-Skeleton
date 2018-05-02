<?php

namespace PRECAST\Vendor\Factory\Adapter\Fallback;

use ApiGen\DependencyInjection\Container\ContainerFactory;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootApiGeneratorInterface;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;
use Symfony\Component\Console\Application;

/**
 * Class FallbackApiGenerator
 * @package PRECAST\Vendor\Factory\Adapter\Fallback
 */
class FallbackApiGenerator implements RootApiGeneratorInterface, RootFallbackInterface
{
    public function generate()
    {

        // Performance boost
        gc_disable();
        require_once(__DIR__ . '/../../../Repository/apigen/apigen/bin/bootstrap.php');
        $container = (new ContainerFactory())->create();
        /** @var Application $application */
        $application = $container->get(Application::class);
        $application->run();
    }
}
