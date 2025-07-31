<?php
declare(strict_types=1);

namespace Pyz\Client\Antelope;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;

/**
 * @method AntelopeFactory getFactory()
 */
interface AntelopeClientInterface
{
    public function getAntelope(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): AntelopeResponseTransfer;

    public function getAntelopeCollection(AntelopeCriteriaTransfer $criteriaTransfer): AntelopeCollectionTransfer;
}
