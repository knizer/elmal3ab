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


if ( ! function_exists("difference_between_datetimes"))
{
    function difference_between_datetimes($older_datetime, $newer_datetime)
    {
		$older_timestamp = strtotime($older_datetime);
		$newer_timestamp = strtotime($newer_datetime);
		$diff_in_seconds = $newer_timestamp - $older_timestamp; // to get the time in seconds from the older to the newer timestamp
        
        $hours = floor($diff_in_seconds / 3600);
		$minutes = floor(($diff_in_seconds / 60) % 60);
		$seconds = $diff_in_seconds % 60;
		
		$result = array("hours" => $hours, "minutes" => $minutes, "seconds" => $seconds);
		return $result;
    }
}


if ( ! function_exists("directory_to_array"))
{
	function directory_to_array($directory)
	{
		$result = array();
		$first_level_dir = scandir($directory);
		
		foreach ($first_level_dir as $key => $value)
		{
			if ( ! in_array($value, array(".", "..")))
			{
				if (is_dir($directory . DIRECTORY_SEPARATOR . $value))
				{
					$result[$value] = directory_to_array($directory . DIRECTORY_SEPARATOR . $value); 
				}
				else
				{
					$result[] = $value; 
				}
			}
		}
		
		return $result; 
	}
}


if ( ! function_exists("print_directory"))
{
    function print_directory($directory_array)
    {
        if (is_array($directory_array) && count($directory_array) > 0)
        {
            echo "<ul>";
            foreach($directory_array as $key => $value)
            {
				if (is_array($value))
				{
					echo "<li>" . $key;
					print_directory($value);
					echo "</li>";
				}
				else
				{
					echo "<li>" . $value . "</li>";
				}
            }
            echo "</ul>";
        }
    }
}


if ( ! function_exists("scrape_keywords"))
{
    function scrape_keywords($from_id, $to_id)
    {
        $CI =& get_instance();
        
        header("Content-Type: text/html; charset=utf-8");
		
		for ($i = $from_id; $i <= $to_id; $i++)
		{
			$url = "http://www.youm7.com/Tags/Index?id=$i&tag=";
		
			// Start the HTML parser with the given url
			$doc = new DOMDocument();
			@$doc->loadHTMLFile($url);
			$xpath = new DOMXPath($doc);
			
			@$keyword = $xpath->query("//div[contains(concat(' ', @id, ' '), ' SectionNews ')]/h1/text()")->item(0)->nodeValue;
			$keyword = ( ! is_null($keyword)) ? trim($keyword) : "";
			if ( ! empty($keyword))
			{
				$CI->common_model->insert_keyword(trim($keyword), $i);
			}
		}
		
		echo "Done.";
    }
}


/* End of file general_helper.php */
/* Location: ./application/helpers/general_helper.php */