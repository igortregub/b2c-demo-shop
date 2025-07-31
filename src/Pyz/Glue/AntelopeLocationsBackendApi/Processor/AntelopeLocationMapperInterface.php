<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;

interface AntelopeLocationMapperInterface
{
    public function mapTransfer(
        AntelopeLocationsBackendApiAttributesTransfer $transfer,
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer;
}
