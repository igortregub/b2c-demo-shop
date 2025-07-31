<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopesBackendApi\Plugin;

use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;
use Pyz\Glue\AntelopesBackendApi\Controller\AntelopesResourceController;
use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;

class AntelopesBackendApiResourcePlugin extends AbstractResourcePlugin implements JsonApiResourceInterface
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return AntelopesBackendApiConfig::RESOURCE_ANTELOPES;
    }

    /**
     * @inheritDoc
     */
    public function getController(): string
    {
        return AntelopesResourceController::class;
    }

    /**
     * @inheritDoc
     */
    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        $collection = new GlueResourceMethodCollectionTransfer();
        $attributes = AntelopesBackendApiAttributesTransfer::class;


        $collection->setGet((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setGetCollection(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAction('getCollectionAction')
                    ->setAttributes($attributes)
            )
            ->setPost((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setPatch((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setDelete(new GlueResourceMethodConfigurationTransfer());

        return $collection;
    }
}

