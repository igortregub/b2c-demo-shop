<?php
declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocation;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * @method AntelopePersistenceFactory getFactory()
 */
class AntelopeEntityManager extends AbstractEntityManager implements
    AntelopeEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        $antelopeEntity = new PyzAntelope();
        $antelopeEntity->fromArray($antelopeTransfer->modifiedToArray());
        $antelopeEntity->save();

        return $antelopeTransfer->fromArray($antelopeEntity->toArray(), true);
    }

    public function createAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        $antelopeEntity = new PyzAntelopeLocation();

        $antelopeEntity->fromArray($antelopeLocationTransfer->modifiedToArray());
        $antelopeEntity->save();

        return $antelopeLocationTransfer->fromArray(
            $antelopeEntity->toArray(),
            true,
        );
    }

    public function updateAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        $antelopeEntity = $this->getFactory()->createAntelopeQuery()
            ->filterByIdAntelope($antelopeTransfer->getIdAntelope())->findOne();
        if (!$antelopeEntity) {
            return $antelopeTransfer;
        }
        $mapper = $this->getFactory()->createAntelopeMapper();
        $antelopeEntity = $mapper->mapAntelopeTransferToEntity(
            $antelopeTransfer,
            $antelopeEntity,
        );
        $antelopeEntity->save();

        return $mapper->mapEntityToAntelopeTransfer(
            $antelopeEntity,
            $antelopeTransfer,
        );
    }

    /**
     * @throws PropelException
     */
    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): int
    {
        return $this->getFactory()
            ->createAntelopeQuery()
            ->filterByPrimaryKey($antelopeTransfer->getIdAntelope())
            ->delete();
    }

    /**
     * @throws PropelException
     */
    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): int
    {
        return $this->getFactory()
            ->createAntelopeLocationQuery()
            ->filterByPrimaryKey($antelopeLocationTransfer->getIdAntelopeLocation())
            ->delete();
    }

    /**
     * @throws PropelException
     * @throws AmbiguousComparisonException
     */
    public function updateAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        $pyzAntelopeLocationEntity = $this->getFactory()
            ->createAntelopeLocationQuery()
            ->filterByIdAntelopeLocation($antelopeLocationTransfer->getIdAntelopeLocation())
            ->findOne();

        $pyzAntelopeLocationEntity = $this->getFactory()->createAntelopeLocationMapper(
        )->mapAntelopeLocationTransferToEntity(
            $antelopeLocationTransfer,
            $pyzAntelopeLocationEntity,
        );
        $pyzAntelopeLocationEntity->save();
        return $this->getFactory()
            ->createAntelopeLocationMapper()
            ->mapAntelopeLocationEntityToTransfer($pyzAntelopeLocationEntity, $antelopeLocationTransfer);
    }
}
