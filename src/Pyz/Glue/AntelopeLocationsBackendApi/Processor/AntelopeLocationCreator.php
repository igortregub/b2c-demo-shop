<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeLocationCreator implements AntelopeLocationCreatorInterface
{
    public function __construct(
        protected AntelopeFacadeInterface $antelopeFacade,
        protected AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        protected AntelopeLocationMapperInterface $antelopeLocationMapper,
    ) {
    }

    public function createAntelopeLocation(
        AntelopeLocationsBackendApiAttributesTransfer $transfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationTransfer = $this->antelopeLocationMapper->mapTransfer(
            $transfer,
            new AntelopeLocationTransfer(),
        );
        $antelopeLocationTransfer = $this->antelopeFacade->createAntelopeLocation($antelopeLocationTransfer);
        $antelopeLocationCollectionTransfer = (new AntelopeLocationCollectionTransfer())->addAntelopeLocation(
            $antelopeLocationTransfer,
        );

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(
            $antelopeLocationCollectionTransfer,
        );
    }
}
