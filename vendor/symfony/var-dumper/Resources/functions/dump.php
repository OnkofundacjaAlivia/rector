<?php

namespace RectorPrefix20210510;

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use RectorPrefix20210510\Symfony\Component\VarDumper\VarDumper;
if (!\function_exists('RectorPrefix20210510\\dump')) {
    /**
     * @author Nicolas Grekas <p@tchwork.com>
     */
    function dump($var, ...$moreVars)
    {
        VarDumper::dump($var);
        foreach ($moreVars as $v) {
            VarDumper::dump($v);
        }
        if (1 < \func_num_args()) {
            return \func_get_args();
        }
        return $var;
    }
}
if (!\function_exists('RectorPrefix20210510\\dd')) {
    function dd(...$vars)
    {
        foreach ($vars as $v) {
            VarDumper::dump($v);
        }
        exit(1);
    }
}