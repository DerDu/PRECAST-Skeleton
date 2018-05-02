<?php

namespace PRECAST\Vendor\Factory\Adapter\Fallback;

use ApiGen\DependencyInjection\Container\ContainerFactory;
use ApiGen\ModularConfiguration\Option\DestinationOption;
use ApiGen\ModularConfiguration\Option\SourceOption;
use PRECAST\Benchmark;
use PRECAST\Environment\Environment;
use PRECAST\Vendor\Exception\AdapterException;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootApiGeneratorInterface;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * Class FallbackApiGenerator
 * @package PRECAST\Vendor\Factory\Adapter\Fallback
 */
class FallbackApiGenerator implements RootApiGeneratorInterface, RootFallbackInterface
{
    /**
     * @throws AdapterException
     * @throws \Exception
     */
    public function generate()
    {
        Benchmark::Log(__CLASS__ . ' START');

        Environment::$hasEnvironment = true;

        try {
            // Performance boost
            gc_disable();
            require_once(__DIR__ . '/../../../Repository/apigen/apigen/bin/bootstrap.php');

            ini_set('memory_limit', '4G');
            ini_set('max_execution_time', '3600');

            $container = (new ContainerFactory())->create();
            /** @var Application $application */
            $application = $container->get(Application::class);
            $application->setAutoExit(false);
            $application->setCatchExceptions(false);

            $input = new ArrayInput([
                'command' => 'generate',
                // (optional) define the value of command arguments
                SourceOption::NAME => [
                    'Vendor/Exception',
                    'Vendor/Factory',
                    'Environment',
                    'Facade',
                ],
                // (optional) pass options to the command
                '--' . DestinationOption::NAME => 'Docs',
            ]);

            // You can use NullOutput() if you don't need the output
            $output = new BufferedOutput();

            $application->run($input, $output);

            // return the output, don't use if you used NullOutput()
            $content = $output->fetch();
            Benchmark::Log($content);

        } catch (NotFoundExceptionInterface $throwable) {
            throw new AdapterException($throwable->getMessage(), $throwable->getCode(), $throwable);
        } catch (ContainerExceptionInterface $throwable) {
            throw new AdapterException($throwable->getMessage(), $throwable->getCode(), $throwable);
        } catch (\Throwable $throwable) {
            throw new AdapterException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }

        Benchmark::Log(__CLASS__ . ' STOP');
    }
}
