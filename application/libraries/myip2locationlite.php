<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class myip2locationlite
{
    public function __construct()
    {
        require_once APPPATH.'third_party/ip2locationlite.php';
    }
}