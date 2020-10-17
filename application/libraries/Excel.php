<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 *  ======================================= 
 *  sumber : https://techarise.com/import-excel-file-mysql-codeigniter/
 *  ======================================= 
 */
require_once APPPATH . "/third_party/PHPExcel.php";
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}
?>