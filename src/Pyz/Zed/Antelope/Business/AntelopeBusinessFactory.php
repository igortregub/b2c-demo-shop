<?php
declare(strict_types=1);

namespace Pyz\Zed\Antelope\Business;

use Pyz\Zed\Antelope\Business\Antelope\Deleter\AntelopeDeleter;
use Pyz\Zed\Antelope\Business\Antelope\Deleter\AntelopeDeleterInterface;
use Pyz\Zed\Antelope\Business\Antelope\Reader\AntelopeReader;
use Pyz\Zed\Antelope\Business\Antelope\Updater\AntelopeUpdater;
use Pyz\Zed\Antelope\Business\Antelope\Updater\AntelopeUpdaterInterface;
use Pyz\Zed\Antelope\Business\Antelope\Writer\AntelopeWriter;
use Pyz\Zed\Antelope\Business\AntelopeLocation\Deleter\AntelopeLocationDeleter;
use Pyz\Zed\Antelope\Business\AntelopeLocation\Reader\AntelopeLocationReader;
use Pyz\Zed\Antelope\Business\AntelopeLocation\Updater\AntelopeLocationUpdater;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method AntelopeEntityManagerInterface getEntityManager()
 * @method AntelopeRepositoryInterface getRepository()
 */
class AntelopeBusinessFactory extends AbstractBusinessFactory
{
    public function createAntelopeWriter(): AntelopeWriter
    {
        return new AntelopeWriter($this->getEntityManager());
    }

    public function createAntelopeLocationWriter(): AntelopeLocationUpdater
    {
        return new AntelopeLocationUpdater($this->getEntityManager());
    }

    public function createAntelopeReader(): AntelopeReader
    {
        return new AntelopeReader($this->getRepository());
    }

    public function createAntelopeLocationReader(): AntelopeLocationReader
    {
        return new AntelopeLocationReader($this->getRepository());
    }

    public function createAntelopeDeleter(): AntelopeDeleterInterface
    {
        return new AntelopeDeleter($this->getEntityManager());
    }

    public function createAntelopeUpdater(): AntelopeUpdaterInterface
    {
        return new AntelopeUpdater($this->getEntityManager());
    }

    public function createAntelopeLocationDeleter(): AntelopeLocationDeleter
    {
        return new AntelopeLocationDeleter($this->getEntityManager());
    }

    public function createAntelopeLocationUpdater(): AntelopeLocationUpdater
    {
        return new AntelopeLocationUpdater($this->getEntityManager());
    }
}
