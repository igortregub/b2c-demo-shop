<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor;

use ArrayObject;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\GlueErrorTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\NullValueException;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponseBuilder implements ErrorResponseBuilderInterface
{
    /**
     * @throws NullValueException
     */
    public function createErrorResponseFromErrorMessage(
        string $errorMessage
    ): GlueResponseTransfer {
        /** @var array<ErrorTransfer> $errorTransfers */
        $errorTransfers = [(new ErrorTransfer())->setMessage($errorMessage)];

        return $this->createErrorResponse(
            new ArrayObject($errorTransfers)
        );
    }

    /**
     * @param ArrayObject<int, ErrorTransfer> $errorTransfers
     *
     * @return GlueResponseTransfer
     * @throws NullValueException
     */
    public function createErrorResponse(
        ArrayObject $errorTransfers,
    ): GlueResponseTransfer {
        $glueResponseTransfer = new GlueResponseTransfer();

        foreach ($errorTransfers as $errorTransfer) {
            $glueErrorTransfer = $this->createGlueErrorTransfer(
                $errorTransfer,
                $errorTransfer->getMessageOrFail(),
            );

            $glueResponseTransfer->addError($glueErrorTransfer);
        }

        return $this->setGlueResponseHttpStatus($glueResponseTransfer);
    }

    private function createGlueErrorTransfer(
        ErrorTransfer $errorTransfer,
        string $message,
    ): GlueErrorTransfer {
        return (new GlueErrorTransfer())
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setMessage($message)
            ->fromArray($errorTransfer->getParameters());
    }

    private function setGlueResponseHttpStatus(GlueResponseTransfer $glueResponseTransfer): GlueResponseTransfer
    {
        $glueErrorTransfers = $glueResponseTransfer->getErrors();

        return $glueResponseTransfer->setHttpStatus(
            $glueErrorTransfers->count() !== 1 ?
                Response::HTTP_MULTI_STATUS : $glueErrorTransfers->getIterator()->current()->getStatus(),
        );
    }
}
