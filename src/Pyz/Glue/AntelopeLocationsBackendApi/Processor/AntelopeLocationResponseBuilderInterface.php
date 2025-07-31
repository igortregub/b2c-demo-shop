<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeLocationResponseBuilderInterface
{
    public function createAntelopeLocationResponse(
        AntelopeLocationCollectionTransfer $collectionTransfer,
    ): GlueResponseTransfer;
}
