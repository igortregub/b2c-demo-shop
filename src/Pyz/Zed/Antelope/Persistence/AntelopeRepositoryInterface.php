<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeRepositoryInterface
{
    public function getAntelope(AntelopeCriteriaTransfer $antelopeCriteria): AntelopeTransfer;
}
