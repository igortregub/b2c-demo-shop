<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Backend\Container;

class AntelopeLocationsBackendApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const string FACADE_ANTELOPE = 'FACADE_ANTELOPE';

    public function provideBackendDependencies(Container $container): Container
    {
        return $this->addAntelopeFacade(parent::provideBackendDependencies($container));
    }

    protected function addAntelopeFacade(Container $container): Container
    {
        $container->set(static::FACADE_ANTELOPE, function (Container $container) {
            return $container->getLocator()->antelope()->facade();
        });

        return $container;
    }
}
