<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>
<?php $this->load->view($this->config->item('ci_my_admin_template_dir_public') . 'header'); ?>
<?php $this->load->view($this->config->item('ci_my_admin_template_dir_public') . 'content'); ?>
<?php $this->load->view($this->config->item('ci_my_admin_template_dir_public') . 'footer'); ?>