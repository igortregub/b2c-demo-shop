<?php
declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer;

    public function createAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer;

    public function updateAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer;

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): int;

    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): int;

    public function updateAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer;
}
