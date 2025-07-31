<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeLocationUpdater implements AntelopeUpdaterInterface
{
    public function __construct(
        protected AntelopeFacadeInterface $antelopeFacade,
        protected readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        protected readonly AntelopeLocationMapperInterface $antelopeLocationMapper,
    ) {
    }

    public function updateAntelopeLocation(
        AntelopeLocationsBackendApiAttributesTransfer $attributesTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationTransfer = $this->antelopeLocationMapper->mapTransfer(
            $attributesTransfer,
            new AntelopeLocationTransfer(),
        );
        $antelopeLocationTransfer = $this->antelopeFacade->updateAntelopeLocation($antelopeLocationTransfer);
        $antelopeLocationCollectionTransfer = (new AntelopeLocationCollectionTransfer())->addAntelopeLocation(
            $antelopeLocationTransfer
        );

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(
            $antelopeLocationCollectionTransfer
        );
    }
}
