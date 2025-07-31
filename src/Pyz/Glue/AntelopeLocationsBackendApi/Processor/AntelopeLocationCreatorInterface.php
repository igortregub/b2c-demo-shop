<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeLocationCreatorInterface
{
    public function createAntelopeLocation(
        AntelopeLocationsBackendApiAttributesTransfer $transfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer;
}
