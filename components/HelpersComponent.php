<?php

namespace app\components;

use Codeception\Command\Console;
use Yii;
use yii\base\Component;

class HelpersComponent extends Component
{

    public function init()
    {
        parent::init();
    }
    public function getIp()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = '127.0.0.1';
        return $ipaddress;
    }

    public function decodeUrl($id = null)
    {
        $codes = Yii::$app->request->get();
        $content = array();
        foreach ($codes as $index => $code) {
            $content[] = $index;
        }
        if (empty($content[0])) {
            return null;
        }
        if (!empty(Yii::$app->encryptUrl->decode($content[0]))) {
            $valueArray = explode("|DODOL|", Yii::$app->encryptUrl->decode($content[0]));
            $value = array();
            for ($i = 0; $i < count($valueArray); $i = $i + 2) {
                $value[$valueArray[$i]] = $valueArray[$i + 1];
            }

            if ($id) {
                if (isset($value[$id])) {
                    return  $value[$id];
                } else {
                    return  null;
                }
            } else {
                return $value;
            }
        } else {
            return  null;
        }
    }

    public function lang($th, $en, $lang = null)
    {
        if ($lang == null) {
            $lang = Yii::$app->users->userlanguage;
        }
        if ($lang  == "en") {
            return $en;
        } else {
            return $th;
        }
    }

    function getInitialName($name)
    {
        $parts = explode(" ", $name);

        $initials = "";
        foreach ($parts as $part) {
            $initials .= substr($part, 0, 1);
        }

        return strtoupper($initials);
    }


    function sessionAccessControl()
    {
        if (empty(Yii::$app->session->get('time_expiration')) || time() > Yii::$app->session->get('time_expiration')) {
            if (Yii::$app->user->identity->ROLE == 1) {
                $model = Yii::$app->db->createCommand('SELECT CFS_MENU.MODULE_ID AS MODULE_ID
                ,CFS_MODULE.MODULE_CODE AS CODE
                ,CFS_MENU.MENU_ID AS MENU_ID
                ,CFS_MENU.PARENT_MENU_ID AS MENU_PID
                ,CFS_MODULE.MODULE_NAME_TH
                ,CFS_MODULE.MODULE_NAME_EN
                ,CFS_MODULE.ICON AS MODULE_ICON
                ,CFS_MENU.MENU_NAME_TH
                ,CFS_MENU.MENU_NAME_EN
                ,CFS_MENU.ICON AS MENU_ICON
                ,CFS_MENU.HREF
                FROM CFS_MENU
                RIGHT JOIN CFS_MODULE ON CFS_MODULE.MODULE_ID = CFS_MENU.MODULE_ID
                WHERE CFS_MENU.FLAG_DEL = 0
                AND CFS_MENU.STATUS = 1
                AND CFS_MODULE.FLAG_DEL = 0
                AND CFS_MODULE.ROLE = 0
                ORDER BY CFS_MODULE.SEQ ASC
                ,MENU_PID ASC
                ,CFS_MENU.SEQ ASC')
                    ->queryAll();
            } else {
                $model = Yii::$app->db->createCommand('SELECT CFS_MENU.MODULE_ID AS MODULE_ID
                ,CFS_MODULE.MODULE_CODE AS CODE
                ,CFS_MENU.MENU_ID AS MENU_ID
                ,CFS_MENU.PARENT_MENU_ID AS MENU_PID
                ,CFS_MODULE.MODULE_NAME_TH
                ,CFS_MODULE.MODULE_NAME_EN
                ,CFS_MODULE.ICON AS MODULE_ICON
                ,CFS_MENU.MENU_NAME_TH
                ,CFS_MENU.MENU_NAME_EN
                ,CFS_MENU.ICON AS MENU_ICON
                ,CFS_MENU.HREF
                FROM CFS_MENU
                RIGHT JOIN CFS_MODULE ON CFS_MODULE.MODULE_ID = CFS_MENU.MODULE_ID
                WHERE CFS_MENU.FLAG_DEL = 0
                AND CFS_MENU.STATUS = 1
                AND CFS_MODULE.FLAG_DEL = 0
                ORDER BY CFS_MODULE.SEQ ASC
                ,MENU_PID ASC
                ,CFS_MENU.SEQ ASC')
                    ->queryAll();
            }
            $menuList = [];
            foreach ($model as $menu) {
                if (empty($menuList[$menu['MODULE_ID']])) {
                    $menuList[$menu['MODULE_ID']] = [
                        'NAME_TH' => $menu['MODULE_NAME_TH'],
                        'NAME_EN' => $menu['MODULE_NAME_EN'],
                        'ICON' => $menu['MODULE_ICON'],
                        'CODE' => $menu['CODE'],
                        'MENU_LIST' => [],
                        'MENU' => []
                    ];
                }
                $menuList[$menu['MODULE_ID']]['MENU_LIST'][$menu['MENU_ID']] = 1;
                if ($menu['MENU_PID'] == '0') {
                    $menuList[$menu['MODULE_ID']]['MENU'][$menu['MENU_ID']] = [
                        'NAME_TH' => $menu['MENU_NAME_TH'],
                        'NAME_EN' => $menu['MENU_NAME_EN'],
                        'HREF' => $menu['HREF'],
                        'ICON' => $menu['MENU_ICON'],
                    ];
                } else {
                    $menuList[$menu['MODULE_ID']]['MENU'][$menu['MENU_PID']]['NAME_SUB'][$menu['MENU_ID']] = [
                        'NAME_TH' => $menu['MENU_NAME_TH'],
                        'NAME_EN' => $menu['MENU_NAME_EN'],
                        'HREF' => $menu['HREF'],
                        'ICON' => $menu['MENU_ICON'],
                    ];
                }
            }
            Yii::$app->session->set('menu_list', $menuList);
            Yii::$app->session->set('time_expiration', time() + Yii::$app->params['accessControlSessionSecond']);
        }
        return Yii::$app->session->get('menu_list');
    }


    public function getMenuID($controller, $action)
    {
        $menuID = array();
        $model = Yii::$app->db->createCommand('SELECT MENU_ID FROM CFS_MENU WHERE HREF = :value')
            ->bindValue(':value', $controller . '/' . $action)->queryAll();
        if (empty($model)) {
            $model = Yii::$app->db->createCommand('SELECT MENU_ID FROM CFS_MENU WHERE HREF = :value')
                ->bindValue(':value', $controller)->queryAll();
            if (empty($model)) {
                $model = Yii::$app->db->createCommand('SELECT MENU_ID FROM CFS_MENU WHERE HREF LIKE :value AND ALLOW_ACTION LIKE :value2')
                    ->bindValue(':value',  $controller . '/%')
                    ->bindValue(':value2', '%' . $action . '%')->queryAll();
                foreach ($model as $m) {
                    $menuID[] = $m['MENU_ID'];
                }
            } else {
                foreach ($model as $m) {
                    $menuID[] = $m['MENU_ID'];
                }
            }
        } else {
            foreach ($model as $m) {
                $menuID[] = $m['MENU_ID'];
            }
        }

        return  $menuID;
    }

    public function isCurrentMenu($menu_id, $menuList)
    {
        if (in_array($menu_id, $menuList)) {
            return true;
        } else {
            return false;
        }
    }

    public function targetBlankCheck($controller)
    {
        foreach (Yii::$app->params['allowTargetBlank'] as $ex) {
            if ($ex == $controller) {
                return true;
            }
        }
        return false;
    }

    public function getBreadcrumbs($bc)
    {

        // $dataMenu = Yii::$app->helpers->sessionAccessControl();
        // $sessionModuleID = Yii::$app->session->get('MODULE_ID');


        // if (!empty($sessionModuleID)) {
        //     $bc->params['breadcrumbs2'][] = [
        //         // 'label' => $this->lang($dataMenu[$sessionModuleID]['NAME_TH'], $dataMenu[$sessionModuleID]['NAME_EN']),
        //         'label' => $this->lang('NAME_TH_1', 'NAME_EN_1'),

        //         'url' => ['cfs/module-sel', 'mod' => 'cfs', 'module_id' =>  $sessionModuleID]
        //     ];
        // }

        $bc->params['breadcrumbs2'][] = [
            'label' => $this->lang('NAME_TH_1', 'NAME_EN_1'),

            'url' => ['cfs/module-sel', 'mod' => 'cfs', 'module_id' =>  '$sessionModuleID']
        ];

        // $bc->params['breadcrumbs2'][] = [
        //     'label' => Yii::t('app', 'Unknown'),
        // ];


        // $controller = Yii::$app->controller->id;
        // $action = Yii::$app->controller->action->id;
        // $menuID = $this->getMenuID($controller, $action);
        // if (count($menuID)) {
        //     $menuList = $dataMenu[$sessionModuleID]['MENU'];
        //     if (count($menuList)) {
        //         $find = 1;
        //         foreach ($menuList as $indexMenu => $menu) {
        //             if ($indexMenu == $menuID[0]) {
        //                 $bc->params['breadcrumbs2'][] = [
        //                     'label' => Yii::$app->helpers->lang($menu['NAME_TH'], $menu['NAME_EN']),
        //                 ];
        //                 $find = 0;
        //             }
        //             if ($find) {
        //                 if (!empty($menu['NAME_SUB'])) {
        //                     foreach ($menu['NAME_SUB'] as $indexMenuSub => $menuSub) {
        //                         if ($indexMenuSub == $menuID[0]) {
        //                             $bc->params['breadcrumbs2'][] = [
        //                                 'label' => Yii::$app->helpers->lang($menuSub['NAME_TH'], $menuSub['NAME_EN']),
        //                             ];
        //                             $find = 0;
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     } else {
        //         if ($controller != 'cfs') {
        //             $bc->params['breadcrumbs2'][] = [
        //                 'label' => Yii::t('app', 'Unknown'),
        //             ];
        //         }
        //     }
        // } else {
        //     if ($controller != 'cfs') {
        //         $bc->params['breadcrumbs2'][] = [
        //             'label' => Yii::t('app', 'Unknown'),
        //         ];
        //     }
        // }
    }
}
