<?php

    use Core\Librerias\Module;
    use Core\Librerias\ModuleAction;

    $modulee = new Module();
    $moduleActions = new ModuleAction();
?>
<div class="portlet box green">
    <div class="m-section__content">
        <div class="portlet-body ">
            <!--begin::Item-->
			<?php foreach ($all_modules as $module) : ?>

                <div class="portlet-body">
                    <div class="row">
                        <div class="col-sm-10 col-md-10">
                            <i class="fa fa-<?php echo $module->icon; ?>"></i>
                            <span class="text-permissions">
                            <?php echo $module->module_parentid; ?>:
                            <?php echo $module->module_id; ?>
                        </span>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="pull-right">
                                <input type="checkbox"
                                       name='permissions[]'
                                       value='<?= $module->module_id; ?>'
									<?php echo ($modulee->has_module_permission($module->module_id, $emp_id)) ? 'checked' : ''; ?>
                                       class='module_checkboxes make-switch'
                                       data-size='small'
                                       data-on-text='Si'
                                       data-off-text='No'
                                       data-on-color='success'
                                       data-off-color='danger'
                                       data-switch='true'>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
						<?php foreach ($moduleActions->getModuleActions($module->module_id) as $module_action) : ?>
                            <div class="col-md-4">
                                <div class="m-checkbox-list">
                                    <label class="m-checkbox">
                                        <input type="checkbox"
                                               id="<?= $module_action->module_id.'|'.$module_action->action_id; ?>"
                                               name='permissions_actions[]'
                                               value='<?= $module_action->module_id.'|'.$module_action->action_id; ?>'
											<?php echo ($modulee->has_module_action_permission($module->module_id, $module_action->action_id, $emp_id)) ? 'checked' : ''; ?>
                                               class='module_action_checkboxes'
                                               data-size='small'
                                               data-on-text='Si'
                                               data-off-text='No'
                                               data-on-color='success'
                                               data-off-color='danger'
                                               data-switch='true'>
										<?php echo $module_action->action_name_key; ?>
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <!-- <?php var_dump($module_action->action_name_key); ?> -->
						<?php endforeach; ?>
                    </div>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    //validation and submit handling
    $(function () {
        $('.module_checkboxes').on('switchChange.bootstrapSwitch', function (event, state) {
            if (state == true) {
                $(this).parent().parent().parent().parent().parent().parent().find('input[type=checkbox]').not(':disabled').prop('checked', true);
            } else {
                $(this).parent().parent().parent().parent().parent().parent().find('input[type=checkbox]').not(':disabled').prop('checked', false);
            }
            console.log(state); // true | false
        });
        /*$(".module_action_checkboxes").change(function()
        {
            alert("asd");
            if ($(this).prop('checked'))
            {
                $('.module_checkboxes').bootstrapSwitch('state', true);
            } else {
                $('.module_checkboxes').bootstrapSwitch('state', false);
            }
        });
*/
    });
</script>