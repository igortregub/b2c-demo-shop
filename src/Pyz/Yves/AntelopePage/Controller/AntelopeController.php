<?php
declare(strict_types=1);

namespace Pyz\Yves\AntelopePage\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Pyz\Yves\AntelopePage\AntelopePageFactory;
use Spryker\Yves\Kernel\View\View;
use SprykerShop\Yves\ShopApplication\Controller\AbstractController;

/**
 * @method AntelopePageFactory getFactory()
 */
class AntelopeController extends AbstractController
{
    public function getAction(string $name): View
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $antelopeCriteriaTransfer->setName($name);

        $antelopeResponseTransfer = $this->getFactory()
            ->getAntelopeClient()
            ->getAntelope($antelopeCriteriaTransfer);

        return $this->view(
            ['antelope' => $antelopeResponseTransfer->getAntelope()],
            [],
            '@AntelopePage/views/antelope/get.twig'
        );
    }

    public function indexAction(): View
    {
        $antelopes = $this->getFactory()
            ->getAntelopeClient()
            ->getAntelopeCollection(new AntelopeCriteriaTransfer())
            ->getAntelopes()
            ->getArrayCopy();

        return $this->view(
            [
                'antelopes' => $antelopes,
            ],
            [],
            '@AntelopePage/views/antelope/index.twig',
        );
    }
}
