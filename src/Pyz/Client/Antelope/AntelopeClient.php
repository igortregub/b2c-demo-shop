<?php
declare(strict_types=1);

namespace Pyz\Client\Antelope;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;
use Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException;

/**
 * @method AntelopeFactory getFactory()
 */
class AntelopeClient extends AbstractClient implements AntelopeClientInterface
{
    /**
     * @throws ContainerKeyNotFoundException
     */
    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer,
    ): AntelopeResponseTransfer {
        return $this->getFactory()->createAntelopeStub()->getAntelope($antelopeCriteriaTransfer);
    }

    /**
     * @throws ContainerKeyNotFoundException
     */
    public function getAntelopeCollection(AntelopeCriteriaTransfer $criteriaTransfer): AntelopeCollectionTransfer
    {
        return $this->getFactory()->createAntelopeStub()->getAntelopeCollection($criteriaTransfer);
    }
}
