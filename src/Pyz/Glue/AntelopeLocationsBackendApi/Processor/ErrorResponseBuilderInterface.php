<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor;

use ArrayObject;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface ErrorResponseBuilderInterface
{
    /**
     * @param ArrayObject<int, ErrorTransfer> $errorTransfers
     */
    public function createErrorResponse(ArrayObject $errorTransfers): GlueResponseTransfer;

    /**
     * @param string $errorMessage
     */
    public function createErrorResponseFromErrorMessage(
        string $errorMessage,
    ): GlueResponseTransfer;
}
