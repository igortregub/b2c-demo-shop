<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor;

use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;

interface AntelopeLocationExpanderInterface
{
    public function expandWithFilters(
        AntelopeLocationConditionTransfer $conditionTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): AntelopeLocationConditionTransfer;
}
