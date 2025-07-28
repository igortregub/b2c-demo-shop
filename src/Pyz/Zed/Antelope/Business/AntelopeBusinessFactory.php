<?php

namespace Pyz\Zed\Antelope\Business;

use Pyz\Zed\Antelope\Business\Reader\AntelopeReader;
use Pyz\Zed\Antelope\Business\Writer\AntelopeWriter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */

class AntelopeBusinessFactory extends AbstractBusinessFactory
{
    public function createAntelopeWriter(): AntelopeWriter
    {
        return new AntelopeWriter(
            $this->getEntityManager()
        );
    }

    public function createAntelopeReader(): AntelopeReader
    {
        return new AntelopeReader(
            $this->getRepository()
        );
    }

}


