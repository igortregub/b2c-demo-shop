<?php
declare(strict_types=1);

namespace Pyz\Client\Antelope;

use Pyz\Client\Antelope\Stub\AntelopeStub;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class AntelopeFactory extends AbstractFactory
{
    /**
     * @throws ContainerKeyNotFoundException
     */
    public function createAntelopeStub(): AntelopeStub
    {
        return new AntelopeStub($this->getZedRequestClient());
    }

    /**
     * @throws ContainerKeyNotFoundException
     */
    public function getZedRequestClient(): ZedRequestClientInterface
    {
        return $this->getProvidedDependency(AntelopeDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
