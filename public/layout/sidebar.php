<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
						<span>
							<?php use Core\Librerias\Module;
                            echo $_SESSION['user_data']['einfo_apellidos'].' <br>'.$_SESSION['user_data']['einfo_nombres']; ?>
							<span class="user-level">Empleado</span>
							<span class="caret"></span>
						</span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">Mi Perfil</span>
                                </a>
                            </li>
                            <li>
                                <a href="/auth/logout">
                                    <span class="link-collapse">Salir</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav" id="menus">
                <li class="nav-item active">
                    <a href="">
                        <i class="fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <li class="nav-section">
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
                    <h4 class="text-section">Modulos</h4>
                </li>
                <?php $modules = new Module(); ?>

                <?php foreach ($modules->getAllowedModules($_SESSION['user_data']['emp_id']) as $module):
                    if (!$modules->countHaveSubMenu($_SESSION['user_data']['emp_id'], $module->module_id)):?>
                        <li class="nav-item">
                            <a href="<?= APP_DIR.$module->module_id; ?>">
                                <i class="fa fa-<?php echo $module->icon; ?>"></i>
                                <p> <?php echo $module->name_lang_key; ?></p>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#<?php echo $module->module_id; ?>">
                                <i class="fa fa-<?php echo $module->icon; ?>"></i>
                                <p><?php echo $module->name_lang_key; ?></p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="<?php echo $module->module_id; ?>">
                                <ul class="nav nav-collapse">
                                    <?php foreach ($modules->getAllowedSubModules($_SESSION['user_data']['emp_id'], $module->module_id) as $s_module): ?>
                                        <li>
                                            <a href="<?= APP_DIR.$s_module->module_id; ?>">
                                                <span class="sub-item">
                                                    <?php echo $s_module->name_lang_key; ?>
                                                </span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div id="ajax">
