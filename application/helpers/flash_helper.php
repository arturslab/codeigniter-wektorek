<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter Flash Helpers
 *
 * Provide helper functions for common flash message operations.
 *
 * @package     CodeIgniter
 * @subpackage  Helpers
 * @category    Helpers
 * @author      Chris Monnat (https://github.com/mrtopher)
 * @commiter    Obedi Ferreira (https://github.com/obxhdx)
 * @link        http://www.christophermonnat.com/2009/05/building-applications-using-codeigniter-part-3-helpers/
 */


/**
 * Display formatted flash message.
 *
 * @param string $name
 * @return string
 */
function display_flash(string $name)
{
	$CI =& get_instance();

	$msg = '';

	if($CI->session->flashdata($name))
	{
		$flash = $CI->session->flashdata($name);

		if(isset($flash['message'])) {
			if (is_array($flash['message'])) {
				$msg .= '<div class="alert alert-' . $flash['message_type'] . '">';

				foreach ($flash['message'] as $flash_message) {
					$msg .= $flash_message . '<br />';
				}

				$msg .= '</div>';
			} else {
				$msg .= '<div class="alert alert-' . $flash['message_type'] . '">' . $flash['message'] . '</div>';
			}
		}

	}

	return $msg;
}

/**
 * Save provided message as a flash variable.
 *
 * @access public
 * @param string $name
 * @param string $message_type
 * @param string $message
 * @param bool   $redirect
 */
function set_flash(string $name, string $message_type, string $message, $redirect=FALSE)
{
	$CI =& get_instance();
	$CI->session->set_flashdata($name, ['message_type' => $message_type, 'message' => $message]);

	if ($redirect) {
		redirect($redirect);
	}
}

/* End of file flash_helper.php */
/* Location: ./application/helpers/flash_helper.php */