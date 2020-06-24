<?php if(isset($env)) { show_filename($env, __FILE__); } ?>
<?php
$sidear_open_class = isset($cookies['sidebar_open']) && $cookies['sidebar_open'] === 1 ? '' : 'toggled';
?>
<!-- Sidebar -->
<ul class="section-sidebar navbar-nav sidebar accordion <?php echo $sidear_open_class; ?>" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin/dashboard'); ?>">
        <div class="sidebar-brand-icon">
<!--        <div class="sidebar-brand-icon rotate-n-15">-->
<!--            <i class="fas fa-laugh-wink"></i>-->
			<img class="img-fluid" src="<?php echo base_url(); ?>assets/admin/images/logo_admin.svg">
        </div>
        <div class="sidebar-brand-text mx-3">Wektorek<sup>pl</sup></div>
    </a>

    <!-- Divider -->
<!--    <hr class="sidebar-divider my-0">-->

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if(in_array($this->uri->segment(2),['dashboard'])){echo 'active';}?>">
        <a class="nav-link" href="<?php echo base_url('admin/dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



	<!-- Heading -->
	<div class="sidebar-heading">
		Blog
	</div>

	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
			<i class="fas fa-file-alt"></i>
			<span>Strony</span>
		</a>
		<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="py-2 collapse-inner rounded">
				<h6 class="collapse-header">Widok logowania:</h6>
				<a class="collapse-item" href="login.html">Logowanie</a>
				<a class="collapse-item" href="register.html">Rejestracja</a>
				<a class="collapse-item" href="forgot-password.html">Przypomnienie hasła</a>
				<div class="collapse-divider"></div>
				<h6 class="collapse-header">Inne strony:</h6>
				<a class="collapse-item" href="404.html">Strona błędu 404</a>
				<a class="collapse-item" href="blank.html">Pusta strona</a>
			</div>
		</div>
	</li>

	<!-- Nav Item - Galleries Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGalleries" aria-expanded="true" aria-controls="collapseGalleries">
			<i class="fas fa-photo-video"></i>
			<span>Galerie</span>
		</a>
		<div id="collapseGalleries" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="py-2 collapse-inner rounded">
				<a class="collapse-item" href="login.html">Galerie zdjęć</a>
				<a class="collapse-item" href="register.html">Galerie filmów</a>
			</div>
		</div>
	</li>


	<!-- Nav Item - Files Collapse Menu -->
	<li class="nav-item <?php if(in_array($this->uri->segment(2),['filesmanager','imagesmanager'])){echo 'active';}?>">
		<a class="nav-link <?php if(!in_array($this->uri->segment(2),['filesmanager','imagesmanager'])){echo 'collapsed';}?>" href="#" data-toggle="collapse" data-target="#collapseFiles" aria-expanded="true" aria-controls="collapseFiles">
			<i class="fas fa-folder"></i>
			<span>Pliki</span>
		</a>
		<div id="collapseFiles" class="collapse <?php if(in_array($this->uri->segment(2),['filesmanager','imagesmanager'])){echo 'show';}?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="py-2 collapse-inner rounded">
				<h6 class="collapse-header">Sekcje:</h6>
				<a class="collapse-item <?php if($this->uri->segment(2)=="filesmanager"){echo 'active';}?>" href="<?php echo base_url('admin/filesmanager'); ?>">Zarządzanie plikami</a>
				<a class="collapse-item" href="register.html">Zarządzanie zdjęciami</a>
				<a class="collapse-item" href="login.html">Zarządzanie filmami</a>
			</div>
		</div>
	</li>


    <!-- Divider -->
    <hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Serwis
	</div>

	<!-- Nav Item - Portal Collapse Menu -->
	<li class="nav-item <?php if(in_array($this->uri->segment(2),['users','usergroups'])){echo 'active';}?>">
		<a class="nav-link <?php if(!in_array($this->uri->segment(2),['users','usergroups'])){echo 'collapsed';}?>" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseZero">
			<i class="fas fa-user"></i>
			<span>Użytkownicy</span>
		</a>
		<div id="collapseUsers" class="collapse <?php if(in_array($this->uri->segment(2),['users','usergroups'])){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="py-2 collapse-inner rounded">
				<h6 class="collapse-header">Sekcje:</h6>
				<a class="collapse-item <?php if($this->uri->segment(2)=="users"){echo 'active';}?>" href="<?php echo base_url('admin/users'); ?>">Użytkownicy</a>
				<a class="collapse-item <?php if($this->uri->segment(2)=="usergroups"){echo 'active';}?>" href="<?php echo base_url('admin/usergroups'); ?>">Grupy użytkowników</a>
			</div>
		</div>
	</li>


    <!-- Nav Item - Settings -->
    <li class="nav-item">
        <a class="nav-link <?php if($this->uri->segment(2)=="settings"){echo 'active';}?>" href="<?php echo base_url('admin/settings'); ?>">
			<i class="fas fa-fw fa-cog"></i>
            <span>Ustawienia</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

	<li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('admin/users/test_page'); ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Test page</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
