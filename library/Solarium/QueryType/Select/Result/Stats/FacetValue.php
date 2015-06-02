<?php
/**
 * Copyright 2011 Bas de Nooijer. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this listof conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDER AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * The views and conclusions contained in the software and documentation are
 * those of the authors and should not be interpreted as representing official
 * policies, either expressed or implied, of the copyright holder.
 *
 * @copyright Copyright 2011 Bas de Nooijer <solarium@raspberry.nl>
 * @license http://github.com/basdenooijer/solarium/raw/master/COPYING
 * @link http://www.solarium-project.org/
 */

/**
 * @namespace
 */
namespace Solarium\QueryType\Select\Result\Stats;

/**
 * Select component stats facet value
 */
class FacetValue
{
    /**
     * Facet value
     *
     * @var string
     */
    protected $value;

    /**
     * Stats data
     *
     * @var array
     */
    protected $stats;

    /**
     * Constructor
     *
     * @param string $field
     * @param array  $stats
     */
    public function __construct($value, $stats)
    {
        $this->value = $value;
        $this->stats = $stats;
    }

    /**
     * Get facet value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * The minimum value of the field/function
     * in all documents in the set.
     *
     * @return string
     */
    public function getMin()
    {
        return $this->getStatValue('min');
    }

    /**
     * The maximum value of the field/function
     * in all documents in the set.
     *
     * @return string
     */
    public function getMax()
    {
        return $this->getStatValue('max');
    }

    /**
     * The sum of all values of the field/function
     * in all documents in the set.
     *
     * @return string
     */
    public function getSum()
    {
        return $this->getStatValue('sum');
    }

    /**
     * The number of values found in all documents
     * in the set for this field/function.
     *
     * @return string
     */
    public function getCount()
    {
        return $this->getStatValue('count');
    }

    /**
     * The number of documents in the set which
     * do not have a value for this field/function.
     *
     * @return string
     */
    public function getMissing()
    {
        return $this->getStatValue('missing');
    }

    /**
     * Sum of all values squared (a by product of computing stddev)
     *
     * @return string
     */
    public function getSumOfSquares()
    {
        return $this->getStatValue('sumOfSquares');
    }

    /**
     * The average (v1 + v2 .... + vN)/N
     *
     * @return string
     */
    public function getMean()
    {
        return $this->getStatValue('mean');
    }

    /**
     * Standard deviation, measuring how
     * widely spread the values in the data set are.
     *
     * @return string
     */
    public function getStddev()
    {
        return $this->getStatValue('stddev');
    }

    /**
     * A list of percentile values based on cut-off
     * points specified by the param value.
     * These values are an approximation, using the t-digest algorithm.
     *
     * @return string
     */
    public function getPercentiles()
    {
        return $this->getStatValue('percentiles');
    }

    /**
     * The set of all distinct values for the field/function
     * in all of the documents in the set. This calculation
     * can be very expensive for fields that do not have a tiny cardinality..
     *
     * @return string
     */
    public function getDistinctValues()
    {
        return $this->getStatValue('distinctValues');
    }

    /**
     * The exact number of distinct values in the field/function
     * in all of the documents in the set.
     * This calculation can be very expensive for
     * fields that do not have a tiny cardinality.
     *
     * @return string
     */
    public function getCountDistinct()
    {
        return $this->getStatValue('countDistinct');
    }


    /**
     * A statistical approximation (currently using the HyperLogLog algorithm)
     * of the number of distinct values in the field/function in all
     * of the documents in the set. This calculation is much more
     * efficient then using the 'countDistinct' option, but may
     * not be 100% accurate. Input for this option can be
     * floating point number between 0.0 and 1.0 indicating
     * how aggressively the algorithm should try to be accurate: 0.0 means
     * use as little memory as possible; 1.0 means use as much
     * memory as needed to be as accurate as possible.
     * 'true' is supported as an alias for "0.3".
     *
     * @return string
     */
    public function getCardinality()
    {
        return $this->getStatValue('cardinality');
    }

    /**
     * Get facet stats
     *
     * @return array
     */
    public function getFacets()
    {
        return $this->getStatValue('facets');
    }

    /**
     * [checkStatKey description]
     * @param  string $key   Stat Key Value
     * @param  void   $value default return value
     * @return void
     */

    private function getStatValue($key, $value = null)
    {
        $value = array_key_exists($key, $this->stats) ? $this->stats[$key] : $value;

        return $value;
    }
}
