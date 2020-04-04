<?php

/**
 * This file is part of Battleground package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Serafim\Bic\Renderer;

use FFI\CData;
use Serafim\Bic\Util;
use SDL\RectPtr;
use SDL\SDL;

/**
 * Trait TransformationTrait
 */
trait TransformMemoizationTrait
{
    /**
     * @var array|RectPtr[]
     */
    protected static array $memoize = [];

    /**
     * @param CData|RectPtr $rect
     * @return CData|RectPtr
     */
    protected function rect(CData $rect): CData
    {
        $id = \spl_object_id($rect);

        if (! isset(self::$memoize[$id])) {
            self::$memoize[$id] = SDL::addr(Util::copyRect($rect));
        }

        return self::$memoize[$id];
    }
}
