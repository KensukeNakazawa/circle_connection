<?php

namespace App\Presenters;

use Exception;
use Illuminate\Support\Carbon;

/**
 * Class BasePresenter
 * @package App\Presenters\Api
 */
abstract class Presenter
{
    /** ex) 9/19(火) 17:00 */
    const FORMAT_DATE_MDHM = 'M/D(ddd) H:mm';

    /**
     * 日付をフォーマットする
     * @param string|null $target_date
     * @return string|null
     * @throws Exception
     */
    protected static function formatDateMDHM(string $target_date=null)
    {
        $format_date = null;

        if (!is_null($target_date)) {
            $date = new Carbon($target_date);
            $format_date = $date->isoFormat(self::FORMAT_DATE_MDHM);
        }

        return $format_date;
    }

}
