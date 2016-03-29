<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists("human_timing"))
{
    function human_timing($timestamp)
    {
        $time = time() - strtotime($timestamp); // to get the time since that moment

        $tokens = array(
            31536000 => 'سنة',
            2592000 => 'شهر',
            604800 => 'أسبوع',
            86400 => 'يوم',
            3600 => 'ساعة',
            60 => 'دقيقة',
            1 => 'ثانية'
        );
    
        foreach ($tokens as $unit => $text)
        {
            if ($time < $unit) continue;
            
            $number_of_units = floor($time / $unit);
            
            return $number_of_units . " " . $text;
        }
    }
}


if ( ! function_exists("seconds_to_unit"))
{
    function seconds_to_unit($time_in_seconds)
    {
        $tokens = array(
            31536000 => 'سنة',
            2592000 => 'شهر',
            604800 => 'أسبوع',
            86400 => 'يوم',
            3600 => 'ساعة',
            60 => 'دقيقة',
            1 => 'ثانية'
        );
        
        foreach ($tokens as $unit => $text)
        {
            if ($time_in_seconds < $unit) continue;
            
            $number_of_units = floor($time_in_seconds / $unit);
            
            return $number_of_units . " " . $text;
        }
    }
}


/* End of file general_helper.php */
/* Location: ./application/helpers/general_helper.php */