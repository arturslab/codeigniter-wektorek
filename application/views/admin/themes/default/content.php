<?php if(isset($env)) { show_filename($env, __FILE__); } ?>
<?php
if (isset($page)) {
    if (isset($module)) {
        $this->load->view("$module/$page");
    } else {
        $this->load->view($page);
    }
}
