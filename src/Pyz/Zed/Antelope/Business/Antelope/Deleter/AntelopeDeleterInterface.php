<?php
declare(strict_types=1);

namespace Pyz\Zed\Antelope\Business\Antelope\Deleter;

use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeDeleterInterface
{
    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): int;
}
