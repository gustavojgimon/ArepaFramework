<h4 class="page-title">Detalles del empleado <span
            style="color:red"><?php echo $empleado->einfo_nombres . ' ' . $empleado->einfo_apellidos; ?></span></h4>
<div id="appEmpleados">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-with-nav">
                <div class="card-header">
                    <div class="row row-nav-line">
                        <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#home"
                                   role="tab" aria-selected="true">Datos empleado
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab"
                                   aria-selected="true">Datos de acceso
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings" role="tab"
                                   aria-selected="true">Permisos
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form id="form_control" method="post" action="<?= APP_DIR; ?>empleados/guardar/<?= $emp_id; ?>">
                    <input type="hidden" name="token" value="<?php echo $token->crearToken(CSRF_TOKEN); ?>"/>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="home">
                                <div class="m-portlet__body">
                                    <!-- vista de informacion basica -->
                                    <?php require 'app/Modulos/empleados/vista/form/empleado_info.php'; ?>
                                    <!-- fin vista informacion basica -->
                                </div>
                            </div>
                            <div class="tab-pane" id="profile">
                                <div class="m-portlet__body">
                                    <!-- vista de permisos empleados -->
                                    <?php require 'app/Modulos/empleados/vista/form/empleado_user_info.php'; ?>
                                    <!-- fin vista permisos basica -->
                                </div>
                            </div>
                            <div class="tab-pane" id="settings">
                                <div class="m-portlet__body">
                                    <!-- vista de permisos empleados -->
                                    <?php require 'app/Modulos/empleados/vista/form/empleado_permisos.php'; ?>
                                    <!-- fin vista permisos basica -->
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-3 mb-3">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile card-secondary">
                <div class="card-header" style="background-image: url('<?= APP_DIR; ?>public/assets/img/blogpost.jpg')">
                    <div class="profile-picture">
                        <div class="avatar avatar-xl">
                            <img src="<?= APP_DIR; ?>public/assets/img/profile.jpg" alt="..."
                                 class="avatar-img rounded-circle">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name"><?php echo $empleado->einfo_nombres . ' ' . $empleado->einfo_apellidos; ?></div>
                        <div class="desc"><?php echo $empleado->einfo_email; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= APP_DIR; ?>public/assetsvuejs/empleados/empleados.js"></script>
</div>