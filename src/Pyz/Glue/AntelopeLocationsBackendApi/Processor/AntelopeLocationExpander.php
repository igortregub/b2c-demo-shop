<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor;

use Generated\Shared\Transfer\AntelopeConditionTransfer;
use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;

class AntelopeLocationExpander implements AntelopeLocationExpanderInterface
{
    public function expandWithFilters(
        AntelopeLocationConditionTransfer $conditionTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): AntelopeLocationConditionTransfer {
        foreach ($glueRequestTransfer->getFilters() as $filter) {
            if ($filter->getResource() !== AntelopesBackendApiConfig::RESOURCE_ANTELOPES) {
                return $conditionTransfer;
            }
            $filterField = $filter->getField();
            $filterValue = $filter->getValue();
            if (!$filterValue) {
                continue;
            }
            switch ($filterField) {
                case AntelopeConditionTransfer::NAME:
                    $conditionTransfer->setName($filterValue);

                    break;
                case AntelopeLocationConditionTransfer::ANTELOPE_LOCATIONS_IDS:
                    $ids = $this->getIds($filterValue);
                    $conditionTransfer->setAntelopeLocationsIds($ids);

                    break;
                case AntelopeLocationConditionTransfer::ID_ANTELOPE_LOCATION:
                    $conditionTransfer->setIdAntelopeLocation((int)$filterValue);

                    break;
            }
        }

        return $conditionTransfer;
    }

    /**
     * @param array<string>|string $filterValue
     *
     * @return array<int>
     */
    private function getIds(string|array $filterValue): array
    {
        if (is_string($filterValue)) {
            $filterValue = explode(',', $filterValue);
        }

        return array_map(
            'intval',
            array_filter(
                $filterValue,
                static fn(string $item) => is_numeric(trim($item)),
            ),
        );
    }
}
