<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor;

use ArrayObject;
use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Symfony\Component\HttpFoundation\Response;

readonly class AntelopeLocationDeleter implements AntelopeLocationDeleterInterface
{
    /**
     * @param AntelopeFacadeInterface $antelopeFacade
     * @param AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder
     * @param ErrorResponseBuilderInterface $errorResponseBuilder
     */
    public function __construct(
        private AntelopeFacadeInterface $antelopeFacade,
        private AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        private ErrorResponseBuilderInterface $errorResponseBuilder,
    ) {
    }

    public function deleteAntelopeLocation(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeLocationTransfer = (new AntelopeLocationTransfer())->setIdAntelopeLocation(
            (int)$glueRequestTransfer->getResource()?->getId(),
        );
        $res = $this->antelopeFacade->deleteAntelopeLocation($antelopeLocationTransfer);
        if (!$res) {
            $errorTransfer = new ErrorTransfer();
            $errorTransfer->setMessage('Antelope not found');
            $errorTransfer->setParameters(
                ['code' => Response::HTTP_NOT_FOUND, 'message' => 'Antelope location not found'],
            );
            $errorTransfers = new ArrayObject();
            $errorTransfers->append($errorTransfer);

            return $this->errorResponseBuilder->createErrorResponse($errorTransfers);
        }

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(
            new AntelopeLocationCollectionTransfer(),
        );
    }
}
