<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use Exception;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeRepository extends AbstractRepository implements AntelopeRepositoryInterface
{
    public function getAntelope(AntelopeCriteriaTransfer $antelopeCriteria): AntelopeTransfer
    {
        $antelopeEntity = $this->getFactory()
            ->createAntelopeQuery()
            ->filterByName($antelopeCriteria->getName())
            ->findOne();

        if (!$antelopeEntity) {
            throw new Exception('Antelope not found');
        }

        $antelopeTransfer = new AntelopeTransfer();
        return $antelopeTransfer->fromArray($antelopeEntity->toArray(), true);
    }
}
