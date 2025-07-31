<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor;

use ArrayObject;
use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Symfony\Component\HttpFoundation\Response;

readonly class AntelopeLocationReader implements AntelopeLocationReaderInterface
{
    public function __construct(
        private AntelopeFacadeInterface $antelopeFacade,
        private AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        private AntelopeLocationExpanderInterface $antelopeLocationExpander,
        private ErrorResponseBuilderInterface $errorResponseBuilder
    ) {
    }

    public function getAntelopeLocation(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        $conditions = new AntelopeLocationConditionTransfer();
        $conditions->setIdAntelopeLocation((int)$glueRequestTransfer->getResource()?->getId());
        $antelopeLocationCriteriaTransfer->setAntelopeLocationsConditions($conditions);

        return $this->getAntelopeLocationCollectionTransfer($antelopeLocationCriteriaTransfer);
    }

    public function getAntelopeLocationCollectionTransfer(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationCollectionTransfer = $this->antelopeFacade
            ->getAntelopeLocationCollection($antelopeLocationCriteriaTransfer);
        if (!$antelopeLocationCollectionTransfer->getAntelopeLocations()->count()) {
            return $this->respondWithErrors();
        }
        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(
            $antelopeLocationCollectionTransfer,
        );
    }

    public function getAntelopeLocationCollection(
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        $conditions = new AntelopeLocationConditionTransfer();
        $this->antelopeLocationExpander->expandWithFilters(
            $conditions,
            $glueRequestTransfer,
        );
        $antelopeLocationCriteriaTransfer->setPagination($glueRequestTransfer->getPagination())
            ->setSortCollection($glueRequestTransfer->getSortings())
            ->setAntelopeLocationsConditions($conditions);

        return $this->getAntelopeLocationCollectionTransfer($antelopeLocationCriteriaTransfer);
    }

    public function respondWithErrors(): GlueResponseTransfer
    {
        $errorTransfer = new ErrorTransfer();
        $errorTransfer->setMessage('Antelope location not found');
        $errorTransfer->setParameters(
            ['status' => Response::HTTP_NOT_FOUND, 'message' => 'Antelope location not found'],
        );
        $errorTransfers = new ArrayObject();
        $errorTransfers->append($errorTransfer);
        return $this->errorResponseBuilder->createErrorResponse(
            $errorTransfers,
        );
    }
}
