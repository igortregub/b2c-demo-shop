<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopesBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractBackendApiFactory;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException;

class AntelopesBackendApiFactory extends AbstractBackendApiFactory
{
    /**
     * @return AntelopeFacadeInterface
     * @throws ContainerKeyNotFoundException
     */
    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopesBackendApiDependencyProvider::FACADE_ANTELOPE);
    }
}

