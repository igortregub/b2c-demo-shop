<?php
declare(strict_types=1);

namespace Pyz\Zed\Antelope\Business\Antelope\Updater;

use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeUpdaterInterface
{
    public function updateAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer;
}
