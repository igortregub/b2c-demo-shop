<?php

namespace Pyz\Zed\Antelope\Business\Reader;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

class AntelopeReader
{
    /**
     * @var \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface
     */
    protected $antelopeRepository;

    public function __construct(AntelopeRepositoryInterface $antelopeRepository)
    {
        $this->antelopeRepository = $antelopeRepository;
    }

    public function getAntelope(AntelopeCriteriaTransfer $antelopeCriteria): AntelopeResponseTransfer
    {
        $antelopeTransfer = $this->antelopeRepository
            ->getAntelope($antelopeCriteria);

        $antelopeResponseTransfer = new AntelopeResponseTransfer();
        $antelopeResponseTransfer
            ->setIsSuccessful(false);

        if ($antelopeTransfer) {
            $antelopeResponseTransfer
                ->setAntelope($antelopeTransfer)
                ->setIsSuccessful(true);
        }

        return $antelopeResponseTransfer;
    }
}
