<?php

if (! function_exists('miladiToPersianDate'))
{
    /**
     * Convert miladi to shamsi
     */
    function
    miladiToPersianDate ($date,
                         $format = 'Y-m-d')
    {


        if (is_null ($date))
        {
            return '';
        }


            $date = \jDate($date);


        return $date->format ($format);
    }
}

if (! function_exists('miladiToPersianDateTime'))
{
	/**
	 * Convert miladi to shamsi
	 */
	function
	miladiToPersianDateTime ($date,
                             $format = 'Y-m-d H:i:s')
	{
	 	return miladiToPersianDate ($date,
                                    $format);
	}
}

if (! function_exists ('persianToMiladiDate'))
{
    /**
     * Convert miladi to shamsi
     */
    function
    persianToMiladiDate ($year,
                         $month,
                         $day,
                         $format = 'Y-m-d')
    {

            $date = \Morilog\Jalali\jDateTime::toGregorianDate ($year,
                                                                $month,
                                                                $day);

        return $date->format ($format);
    }
}
