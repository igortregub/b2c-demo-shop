<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Oms;

use Spryker\Zed\Oms\OmsConfig as SprykerOmsConfig;

class OmsConfig extends SprykerOmsConfig
{
    public const string CUSTOM_ORDER_PROCESS = 'CUSTOM_ORDER_PROCESS';

    /**
     * @return string
     */
    public function getFallbackDisplayNamePrefix(): string
    {
        return 'oms.state.';
    }
}
