<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Plugin;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiConfig;
use Pyz\Glue\AntelopeLocationsBackendApi\Controller\AntelopeLocationsResourceController;
use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;

class AntelopeLocationsBackendApiResourcePlugin extends AbstractResourcePlugin implements JsonApiResourceInterface
{
    public function getType(): string
    {
        return AntelopeLocationsBackendApiConfig::RESOURCE_ANTELOPE_LOCATIONS;
    }

    public function getController(): string
    {
        return AntelopeLocationsResourceController::class;
    }

    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        $attributes = AntelopeLocationsBackendApiAttributesTransfer::class;

        $glueResourceMethodCollectionTransfer = new GlueResourceMethodCollectionTransfer();
        return $glueResourceMethodCollectionTransfer
            ->setGetCollection(
                $this->getGlueResourceMethodConfigurationTransfer()->setAttributes($attributes)
            )
            ->setPost(
                $this->getGlueResourceMethodConfigurationTransfer()->setAttributes($attributes)
            )
            ->setGet(
                $this->getGlueResourceMethodConfigurationTransfer()->setAttributes($attributes)
            )
            ->setPatch(
                $this->getGlueResourceMethodConfigurationTransfer()->setAttributes($attributes)
            )
            ->setDelete(
                $this->getGlueResourceMethodConfigurationTransfer()
            );
    }

    private function getGlueResourceMethodConfigurationTransfer(): GlueResourceMethodConfigurationTransfer
    {
        return new GlueResourceMethodConfigurationTransfer();
    }
}
