<?php

use yii\helpers\Url;

$dataMenu = Yii::$app->helpers->sessionAccessControl();
$sessionModuleID = Yii::$app->session->get('MODULE_ID');
?>
<div id="left-sidebar" class="sidebar ">
    <h5 class="brand-name px-2">WU - STMS</h5>
    <nav id="left-sidebar-nav" class="sidebar-nav ">
        <ul class="metismenu" style="border-top: 1px solid rgba(255, 255, 255, 0.07);">
            <?php
            if (!empty($sessionModuleID)) {
            ?>
                <li class="g_heading mt-2 px-2">
                </li>
                <?php
                $action_current = Yii::$app->controller->action->id;
                $module_current = Yii::$app->controller->id;
                $currentMenuID = Yii::$app->helpers->getMenuID($module_current, $action_current);
                foreach ($dataMenu[$sessionModuleID]['MENU'] as $indexMenu => $menu) {
                    $moduleCode = $dataMenu[$sessionModuleID]['CODE'];
                    if (!empty($menu['NAME_SUB'])) {
                        $sub_active = 0;
                        foreach ($menu['NAME_SUB'] as $indexMenuSub => $menuSub) {
                            if (Yii::$app->helpers->isCurrentMenu($indexMenuSub, $currentMenuID)) {
                                $sub_active++;
                            }
                        }
                        $act =  $sub_active  ? "active" : "";
                        $in = $sub_active  ? "in" : "";
                    } else {
                        $act = Yii::$app->helpers->isCurrentMenu($indexMenu, $currentMenuID) ? "active" : '';
                        $in = Yii::$app->helpers->isCurrentMenu($indexMenu, $currentMenuID) ? "in" : '';
                    }
                    $href = strpos($menu['HREF'], "/") ?  $menu['HREF'] : $menu['HREF'] . '/index';
                    $target = Yii::$app->helpers->targetBlankCheck($href) ? '_blank' : '';

                ?>
                    <li class="<?= $act ?> px-2" id="show-active<?= $indexMenu  ?>">
                        <a href="<?= !empty($menu['NAME_SUB']) ? $menu['HREF'] :  Url::to([$href, 'mod' => $moduleCode]) ?>" class="has-arrow arrow-c" data-select-menu="<?= $indexMenu ?>" data-menu-name="<?= $menu['NAME_EN'] ?>" target="<?= $target ?>">
                            <i class="nav-icon <?= $menu['ICON'] ?>"></i>
                            <span>
                                <?= Yii::$app->helpers->lang($menu['NAME_TH'], $menu['NAME_EN']) ?>
                            </span>
                            <?php if (!empty($menu['NAME_SUB'])) { ?> <i class="nav-icon fas fa-angle-down right"></i><?php  } ?>
                        </a>
                        <?php if (!empty($menu['NAME_SUB'])) { ?>
                            <ul aria-expanded="true" id="show-menu<?= $indexMenu ?>" class="collapse <?= $in ?>">
                                <?php
                                foreach ($menu['NAME_SUB'] as $indexMenuSub => $menuSub) {
                                    $act_s = Yii::$app->helpers->isCurrentMenu($indexMenuSub, $currentMenuID) ? "active" : '';
                                    $href = strpos($menuSub['HREF'], "/") ?  $menuSub['HREF'] : $menuSub['HREF'] . '/index';
                                    $target = Yii::$app->helpers->targetBlankCheck($href) ? '_blank' : '';
                                ?>
                                    <li class="<?= $act_s ?>">
                                        <a href="<?= Url::to([$href, 'mod' => $moduleCode]) ?>" class="switch_module" data-module-id="<?= $indexMenu ?>" target="<?= $target ?>">
                                            <span> <?= Yii::$app->helpers->lang($menuSub['NAME_TH'], $menuSub['NAME_EN']) ?></span>
                                        </a>
                                    </li>
                                <?php

                                }
                                ?>
                            </ul>
                        <?php  } ?>
                    </li>
                <?php
                }
                ?>
                <li class="px-2" style="border-top: 1px solid rgba(255, 255, 255, 0.07);">
                    <a href="<?= Url::to(['site/index']) ?>" id="cancel_module" class="has-arrow arrow-c" aria-expanded="true">
                        <i class="nav-icon fe fe-log-out"></i><span> <?php echo Yii::t('app', 'Change system'); ?></span>
                    </a>
                </li>
                <?php
            } else {
                foreach ($dataMenu as $indexModule => $dataModule) {
                    $act = "";
                    if (!empty($sessionModuleID) && $sessionModuleID ==  $indexModule) {
                        $act = "active";
                    }
                ?>
                    <li class="<?= $act ?> px-2">
                        <a href="<?= Url::to(['cfs/module-sel', 'mod' => 'cfs', 'module_id' =>  $indexModule]) ?>" class="has-arrow arrow-c switch_module" data-menu-id="<?= $indexModule ?>" data-module-id="<?= $indexModule ?>" data-main-menu-name="<?= $dataModule['NAME_EN'] ?>">
                            <i class="nav-icon <?= $dataModule['ICON'] ?>"></i> <span>
                                <?= Yii::$app->helpers->lang($dataModule['NAME_TH'], $dataModule['NAME_EN'])  ?>
                            </span>
                        </a>
                    </li>
            <?php
                }
            }
            ?>
        </ul>
    </nav>
</div>