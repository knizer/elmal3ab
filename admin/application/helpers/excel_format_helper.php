<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists("clean_data"))
{
    function clean_data(&$str)
    {
        // Unescape special characters
        $str = htmlspecialchars_decode($str);
        
        // Escape tab characters
        $str = preg_replace("/\t/", "\\t", $str);
        
        // Escape new lines
        $str = preg_replace("/\r?\n/", "\\n", $str);
        
        // Force certain number/date formats to be imported as strings
        if (preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str))
        {
            $str = "'$str'";
        }
        
        // Escape fields that include double quotes
        if (strstr($str, '"'))
        {
            $str = '"' . str_replace('"', '""', $str) . '"';
        }
        
        // Convert from UTF-8 to Windows-1256 encoding which Excel handles better
        //$str = mb_convert_encoding($str, 'UTF-16LE', 'UTF-8');
    }
}


/* End of file excel_format_helper.php */
/* Location: ./application/helpers/excel_format_helper.php */