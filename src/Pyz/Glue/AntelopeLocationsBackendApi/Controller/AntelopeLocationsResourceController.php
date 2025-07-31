<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Controller;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiFactory;
use Spryker\Glue\Kernel\Backend\Controller\AbstractController;

/**
 * @method AntelopeLocationsBackendApiFactory getFactory()
 */
class AntelopeLocationsResourceController extends AbstractController
{
    public function getCollectionAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        return $this->getFactory()
            ->createAntelopeLocationReader()
            ->getAntelopeLocationCollection($glueRequestTransfer);
    }

    public function getAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        return $this->getFactory()
            ->createAntelopeLocationReader()
            ->getAntelopeLocation($glueRequestTransfer);
    }

    public function postAction(
        AntelopeLocationsBackendApiAttributesTransfer $antelopeLocationsBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        return $this->getFactory()
            ->createAntelopeLocationWriter()
            ->createAntelopeLocation(
                $antelopeLocationsBackendApiAttributesTransfer,
                $glueRequestTransfer,
            );
    }

    public function patchAction(
        AntelopeLocationsBackendApiAttributesTransfer $antelopeLocationsBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationsBackendApiAttributesTransfer->setIdAntelopeLocation(
            (int)$glueRequestTransfer->getResource()?->getId(),
        );
        return $this->getFactory()->createAntelopeLocationUpdater()->updateAntelopeLocation(
            $antelopeLocationsBackendApiAttributesTransfer,
            $glueRequestTransfer,
        );
    }

    public function deleteAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        return $this->getFactory()
            ->createAntelopeLocationDeleter()
            ->deleteAntelopeLocation($glueRequestTransfer);
    }
}
