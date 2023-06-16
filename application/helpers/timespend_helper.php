<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('fbdate'))
{

    function fbdate($datetime)
    {
        $CI =& get_instance();
        $CI->lang->load('date');
        date_default_timezone_set("Asia/Jakarta"); 
        
        if(!is_numeric($datetime))
        {
            $val = explode(" ",$datetime);
           $date = explode("-",$val[0]);
           $time = explode(":",$val[1]);
           $datetime = mktime($time[0],$time[1],$time[2],$date[1],$date[2],$date[0]);
        }
        
        $difference = time() - $datetime;
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        //$periods = array("detik", "menit", "jam", "hari", "minggu", "bulan", "tahun", "dekade");
        $lengths = array("60","60","24","7","4.35","12","10");

        if ($difference > 0) 
        { 
            $ending = $CI->lang->line('date_ago');
        } 
        else 
        { 
            $difference = -$difference;
            $ending = $CI->lang->line('date_to_go');
        }
        for($j = 0; $difference >= $lengths[$j]; $j++)
        {
            $difference /= $lengths[$j];
        } 
        $difference = round($difference);
        
        if($difference != 1) 
        { 
            $period = strtolower($CI->lang->line('date_'.$periods[$j].'s'));
        } else {
            $period = strtolower($CI->lang->line('date_'.$periods[$j]));
        }
        
        return "$difference $period $ending";
        //return sprintf($CI->lang->line('timespan_format'), $difference, $period, $ending); 
    }
        
    function fbdateTask($datetime)
    {
        $CI =& get_instance();
        $CI->lang->load('date');
        
        if(!is_numeric($datetime))
        {
            $val = explode(" ",$datetime);
           $date = explode("-",$val[0]);
           $time = explode(":",$val[1]);
           $datetime = mktime(0,0,0,$date[1],$date[2],$date[0]);
        }
        $now=date("Y-m-d H:i:s");
        if(!is_numeric($now))
        {
            $val = explode(" ",$now);
           $date = explode("-",$val[0]);
           $time = explode(":",$val[1]);
           $datetimeNow = mktime(0,0,0,$date[1],$date[2],$date[0]);
        }
        
        $difference = $datetimeNow - $datetime;
        //if(abs($difference)>=(3600*12)) $difference=$difference*2;
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        //$periods = array("detik", "menit", "jam", "hari", "minggu", "bulan", "tahun", "dekade");
        $lengths = array("60","60","24","7","4.35","12","10");

        if ($difference > 0) 
        { 
            //$ending = $CI->lang->line('date_ago');
            $ending = 'ago';
        } 
        else 
        { 
            $difference = -$difference;
            //$ending = $CI->lang->line('date_to_go');
            $ending = 'to go';
        }
        for($j = 0; $difference >= $lengths[$j]; $j++)
        {
            $difference /= $lengths[$j];
        } 
        $difference = round($difference);
        
        if($difference != 1) 
        { 
            $period = strtolower($CI->lang->line('date_'.$periods[$j].'s'));
        } else {
            $period = strtolower($CI->lang->line('date_'.$periods[$j]));
        }
        
        $hasil="$difference $period $ending";
        if($hasil=='1 day ago') $hasil='Yesterday';else
        if($hasil=='1 day to go') $hasil='Tomorrow';else
        if($hasil=='0 seconds to go') $hasil='Today';
        return $hasil;
        //return sprintf($CI->lang->line('timespan_format'), $difference, $period, $ending); 
    }
} 