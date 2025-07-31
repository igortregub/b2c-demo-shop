<?php
declare(strict_types=1);

namespace Pyz\Zed\Antelope\Business\Antelope\Deleter;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

readonly class AntelopeDeleter implements AntelopeDeleterInterface
{
    public function __construct(
        private AntelopeEntityManagerInterface $antelopeEntityManager,
    ) {
    }

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): int
    {
        return $this->antelopeEntityManager->deleteAntelope($antelopeTransfer);
    }
}
