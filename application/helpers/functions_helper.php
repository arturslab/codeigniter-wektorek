<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');

/*
 * Some helper functions
 * 
 * @category	Library
 * @author		Artur Słaboszewski <a.slaboszewski@gmail.com>
 * @copyright	2020 melma.pl
 * @license		All right reserved melma.pl
 */

if ( !function_exists('sample'))
{
    function sample($data)
    {
        
    	return $data;
    }
}

if (!function_exists('show_filename')) {

    function show_filename($env='prod', $var)
    {
        if($env==='dev') {

            echo '<div class="card ml-2 mr-2 mb-2 mt-2 shadow card-debug">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header bg-gradient-primary" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-white">Dev info</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample" style="">
                  <div class="card-body">
                    <small><strong>Out: </strong>' . $var . '</small>
                  </div>
                </div>
              </div>';
        }
    }
}

if (!function_exists('date_time')) {

    function date_time($datetime)
    {
        $_datetime = new DateTime($datetime);
        $date = $_datetime->format('Y-m-d');
        $time = $_datetime->format('H:i');

        return ['date' => $date, 'time' => $time];
    }
}


/* End of file */
/* Location: ./application/helpers/functions_helper.php */