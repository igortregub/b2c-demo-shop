<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopesBackendApi\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiFactory;
use Spryker\Glue\Kernel\Backend\Controller\AbstractController;
use Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException;

/**
 * @method AntelopesBackendApiFactory getFactory()
 */
class AntelopesResourceController extends AbstractController
{
    /**
     * @throws ContainerKeyNotFoundException
     */
    public function getCollectionAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $antelopes = $this->getFactory()
            ->getAntelopeFacade()
            ->getAntelopeCollection($antelopeCriteriaTransfer)
            ->getAntelopes();
        $responseTransfer = new GlueResponseTransfer();

        foreach ($antelopes as $antelope) {
            $resource = new GlueResourceTransfer();
            $resource->setType(AntelopesBackendApiConfig::RESOURCE_ANTELOPES);
            $resource->setId('' . $antelope->getIdAntelope());
            $attributes = new AntelopesBackendApiAttributesTransfer();
            $attributes->fromArray($antelope->toArray(), true);

            $resource->setAttributes($attributes);
            $responseTransfer->addResource($resource);
        }

        return $responseTransfer;
    }
}
