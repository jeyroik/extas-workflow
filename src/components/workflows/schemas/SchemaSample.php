<?php
namespace extas\components\workflows\schemas;

use extas\components\samples\Sample;
use extas\components\workflows\entities\THasEntitySample;
use extas\interfaces\workflows\schemas\ISchemaSample;

/**
 * Class SchemaSample
 *
 * @package extas\components\workflows\schemas
 * @author jeyroik@gmail.com
 */
class SchemaSample extends Sample implements ISchemaSample
{
    use THasEntitySample;
}
