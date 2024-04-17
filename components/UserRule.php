<?php

/**
 * Created by CDTWU
 * User: Hakim Mudor
 * Date: 21/06/2023
 * Time: 14:41
 */


//  เงื่อนไขการใช้งาน roles 
//  '@'     => บังคับ เข้าสู่ระบบ และ บังคับ เลือกสิทธิ์
//  '!'     => บังคับ เข้าสู่ระบบ และ ไม่บังคับ เลือกสิทธิ์
//  '?'     => บังคับ ยังไม่เข้าระบบ
//  ไม่กำหนด roles   => ไม่ตรวจสอบทุกเงื่อนไข

namespace app\components;

use yii\filters\AccessRule;

class UserRule extends AccessRule
{
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } else if ($role === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                    //return $this->identityRule($user);
                }
            } else if ($role === '!') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            }
        }
        return false;
    }
}
