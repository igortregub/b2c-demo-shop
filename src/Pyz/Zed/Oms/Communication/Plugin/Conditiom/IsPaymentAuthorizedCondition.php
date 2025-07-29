<?php
declare(strict_types=1);

namespace Pyz\Zed\Oms\Communication\Plugin\Conditiom;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Condition\AbstractCondition;

class IsPaymentAuthorizedCondition extends AbstractCondition
{
    public function check(SpySalesOrderItem $orderItem): true
    {
        // TODO: Implement check() method.

        return true;
    }
}
