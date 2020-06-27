<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>
<?php if(isset($module_description) && !empty($module_description)) { ?>
	<!-- Module description -->
<div class="section-module-description card border-left-primary shadow h-100 py-2 mb-4 module-description">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <?php echo isset($module_description) ? $module_description : ''; ?>
            </div>
            <div class="col-auto">
                <i class="fas fa-info fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>
</div>
<?php } ?>