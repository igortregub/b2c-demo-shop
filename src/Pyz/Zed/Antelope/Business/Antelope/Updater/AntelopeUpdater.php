<?php
declare(strict_types=1);

namespace Pyz\Zed\Antelope\Business\Antelope\Updater;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

readonly class AntelopeUpdater implements AntelopeUpdaterInterface
{
    public function __construct(
        private AntelopeEntityManagerInterface $antelopeEntityManager,
    ) {
    }

    public function updateAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        return $this->antelopeEntityManager->updateAntelope($antelopeTransfer);
    }
}
