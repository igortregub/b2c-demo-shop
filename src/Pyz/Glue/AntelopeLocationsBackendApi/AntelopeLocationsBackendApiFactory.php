<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi;

use Pyz\Glue\AntelopeLocationsBackendApi\Processor\AntelopeLocationCreator;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\AntelopeLocationCreatorInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\AntelopeLocationDeleter;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\AntelopeLocationExpander;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\AntelopeLocationExpanderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\AntelopeLocationMapper;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\AntelopeLocationMapperInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\AntelopeLocationReader;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\AntelopeLocationReaderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\AntelopeLocationResponseBuilder;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\AntelopeLocationResponseBuilderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ErrorResponseBuilder;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ErrorResponseBuilderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\AntelopeLocationUpdater;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\AntelopeUpdaterInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Spryker\Glue\Kernel\Backend\AbstractFactory;
use Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException;

class AntelopeLocationsBackendApiFactory extends AbstractFactory
{
    /**
     * @throws ContainerKeyNotFoundException
     */
    public function createAntelopeLocationReader(): AntelopeLocationReaderInterface
    {
        return new AntelopeLocationReader(
            $this->getAntelopeFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationExpander(),
            $this->createErrorResponseBuilder(),
        );
    }

    /**
     * @throws ContainerKeyNotFoundException
     */
    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeLocationsBackendApiDependencyProvider::FACADE_ANTELOPE);
    }

    public function createAntelopeLocationResponseBuilder(): AntelopeLocationResponseBuilderInterface
    {
        return new AntelopeLocationResponseBuilder();
    }

    public function createAntelopeLocationExpander(): AntelopeLocationExpanderInterface
    {
        return new AntelopeLocationExpander();
    }

    private function createErrorResponseBuilder(): ErrorResponseBuilderInterface
    {
        return new ErrorResponseBuilder();
    }

    /**
     * @throws ContainerKeyNotFoundException
     */
    public function createAntelopeLocationWriter(): AntelopeLocationCreatorInterface
    {
        return new AntelopeLocationCreator(
            $this->getAntelopeFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationMapper(),
        );
    }

    public function createAntelopeLocationMapper(): AntelopeLocationMapperInterface
    {
        return new AntelopeLocationMapper();
    }

    /**
     * @throws ContainerKeyNotFoundException
     */
    public function createAntelopeLocationUpdater(): AntelopeUpdaterInterface
    {
        return new AntelopeLocationUpdater(
            $this->getAntelopeFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationMapper(),
        );
    }

    /**
     * @throws ContainerKeyNotFoundException
     */
    public function createAntelopeLocationDeleter(): AntelopeLocationDeleter
    {
        return new AntelopeLocationDeleter(
            $this->getAntelopeFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createErrorResponseBuilder(),
        );
    }
}
