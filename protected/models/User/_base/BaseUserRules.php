<?php

/**
 * This is the model base class for the table "UserRules".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "UserRules".
 *
 * Columns in table "UserRules" available as properties of the model,
 * followed by relations of table "UserRules" available as properties of the model.
 *
 * @property string $id
 * @property string $role_id
 * @property string $module_id
 * @property string $privileges_controller
 * @property string $privileges_actions
 * @property string $role_desc
 * @property string $permission
 * @property string $permission_type
 *
 * @property Module $module
 * @property UserRole $role
 */
abstract class BaseUserRules extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'UserRules';
    }

    public static function label($n = 1) {
        return Yii::t('app', 'UserRules|UserRules', $n);
    }

    public static function representingColumn() {
        return 'PrivilegesController';
    }

    public function rules() {
        return array(
            array('ModuleId', 'required'),
            array('RoleId, ModuleId', 'length', 'max'=>10),
            array('PrivilegesController, PrivilegesActions', 'length', 'max'=>100),
            array('RoleDesc, PermissionType', 'length', 'max'=>255),
            array('Permission', 'length', 'max'=>5),
            array('RoleId, PrivilegesController, PrivilegesActions, RoleDesc, Permission, PermissionType', 'default', 'setOnEmpty' => true, 'value' => null),
            array('Id, RoleId, ModuleId, PrivilegesController, PrivilegesActions, RoleDesc, Permission, PermissionType', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'module' => array(self::BELONGS_TO, 'Module', 'ModuleId'),
            'role' => array(self::BELONGS_TO, 'UserRole', 'RoleId'),
        );
    }

    public function pivotModels() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'Id' => Yii::t('app', 'ID'),
            'RoleId' => null,
            'ModuleId' => null,
            'PrivilegesController' => Yii::t('app', 'Privileges Controller'),
            'PrivilegesActions' => Yii::t('app', 'Privileges Actions'),
            'RoleDesc' => Yii::t('app', 'Role Desc'),
            'Permission' => Yii::t('app', 'Permission'),
            'PermissionType' => Yii::t('app', 'Permission Type'),
            'Module' => null,
            'Role' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('Id', $this->Id, true);
        $criteria->compare('RoleId', $this->RoleId);
        $criteria->compare('ModuleId', $this->ModuleId);
        $criteria->compare('PrivilegesController', $this->PrivilegesController, true);
        $criteria->compare('PrivilegesActions', $this->PrivilegesActions, true);
        $criteria->compare('RoleDesc', $this->RoleDesc, true);
        $criteria->compare('Permission', $this->Permission, true);
        $criteria->compare('PermissionType', $this->PermissionType, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}