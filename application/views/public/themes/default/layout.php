<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>
<?php
$this->load->view($this->config->item('ci_my_admin_template_dir_public') . 'header');
$this->load->view($this->config->item('ci_my_admin_template_dir_public') . 'content');
$this->load->view($this->config->item('ci_my_admin_template_dir_public') . 'footer');