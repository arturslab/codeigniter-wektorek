<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** application/libraries/MY_Form_validation **/
class MY_Form_validation extends CI_Form_validation
{

    function run($module = '', $group = '')
    {
        (is_object($module)) and $this->CI = &$module;

        return parent::run($group);
    }
}