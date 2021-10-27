<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Symfony;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import($this->getProjectDir().'/config/{packages}/*.yaml');
        $container->import($this->getProjectDir().'/config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file($this->getProjectDir().'/config/services.yaml')) {
            $container->import($this->getProjectDir().'/config/services.yaml');
            $container->import($this->getProjectDir().'/config/{services}_'.$this->environment.'.yaml');

            return;
        }

        $container->import($this->getProjectDir().'/config/{services}.php');
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import($this->getProjectDir().'/config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import($this->getProjectDir().'/config/{routes}/*.yaml');

        if (is_file($this->getProjectDir().'/config/routes.yaml')) {
            $routes->import($this->getProjectDir().'/config/routes.yaml');

            return;
        }

        $routes->import($this->getProjectDir().'/config/{routes}.php');
    }
}
