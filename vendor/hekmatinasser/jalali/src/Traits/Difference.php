<?php

namespace Hekmatinasser\Jalali\Traits;

use DateTime;
use Exception;
use Hekmatinasser\Jalali\Jalali;

trait Difference
{
    /**
     * Get the difference in years
     *
     * @param Jalali|DateTime|string|int|null $datetime
     * @param bool $absolute Get the absolute of the difference
     * @return int
     * @throws Exception
     */
    public function diffYears(Jalali|DateTime|string|int|null $datetime = null, bool $absolute = true): int
    {
        $datetime = $this->resolve($datetime);

        $diff = $this->year - $datetime->year;

        return $absolute ? abs($diff) : $diff;
    }

    /**
     * Get the difference in months
     *
     * @param Jalali|DateTime|string|int|null $datetime
     * @param bool $absolute Get the absolute of the difference
     * @return int
     * @throws Exception
     */
    public function diffMonths(Jalali|DateTime|string|int|null $datetime = null, bool $absolute = true): int
    {
        $datetime = $this->resolve($datetime);

        $diff = (($this->year * static::MONTHS_PER_YEAR) + $this->month) -
            (($datetime->year * static::MONTHS_PER_YEAR) + $datetime->month);

        return $absolute ? abs($diff) : $diff;
    }

    /**
     * Get the difference in weeks
     *
     * @param Jalali|DateTime|string|int|null $datetime
     * @param bool $absolute Get the absolute of the difference
     * @return int
     * @throws Exception
     */
    public function diffWeeks(Jalali|DateTime|string|int|null $datetime = null, bool $absolute = true): int
    {
        return (int) ($this->diffDays($datetime, $absolute) / static::DAYS_PER_WEEK);
    }

    /**
     * Get the difference in days
     *
     * @param Jalali|DateTime|string|int|null $datetime
     * @param bool $absolute Get the absolute of the difference
     * @return int
     * @throws Exception
     */
    public function diffDays(Jalali|DateTime|string|int|null $datetime = null, bool $absolute = true): int
    {
        $datetime = $this->resolve($datetime);

        return (int) $this->diff($datetime->datetime(), $absolute)->format('%r%a');
    }

    /**
     * Get the difference in hours
     *
     * @param Jalali|DateTime|string|int|null $datetime
     * @param bool $absolute Get the absolute of the difference
     * @return int
     */
    public function diffHours(Jalali|DateTime|string|int|null $datetime = null, bool $absolute = true): int
    {
        return (int) ($this->diffSeconds($datetime, $absolute) / static::SECONDS_PER_MINUTE / static::MINUTES_PER_HOUR);
    }

    /**
     * Get the difference in minutes
     *
     * @param Jalali|DateTime|string|int|null $datetime
     * @param bool $absolute Get the absolute of the difference
     * @return int
     */
    public function diffMinutes(Jalali|DateTime|string|int|null $datetime = null, bool $absolute = true): int
    {
        return (int) ($this->diffSeconds($datetime, $absolute) / static::SECONDS_PER_MINUTE);
    }

    /**
     * Get the difference in seconds
     *
     * @param Jalali|DateTime|string|int|null $datetime
     * @param bool $absolute Get the absolute of the difference
     * @return int
     */
    public function diffSeconds(Jalali|DateTime|string|int|null $datetime = null, bool $absolute = true): int
    {
        $datetime = $this->resolve($datetime);

        $diff = $datetime->getTimestamp() - $this->getTimestamp();

        return $absolute ? abs($diff) : $diff;
    }
}
