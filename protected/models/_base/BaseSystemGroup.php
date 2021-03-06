<?php

/**
 * This is the model base class for the table "SystemGroup".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "SystemGroup".
 *
 * Columns in table "SystemGroup" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $Id
 * @property string $Name
 * @property integer $Position
 * @property integer $Status
 *
 */
abstract class BaseSystemGroup extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'SystemGroup';
    }

    public static function label($n = 1) {
        return Yii::t('app', 'SystemGroup|SystemGroups', $n);
    }

    public static function representingColumn() {
        return 'Name';
    }

    public function rules() {
        return array(
            array('Position, Status', 'numerical', 'integerOnly'=>true),
            array('Name', 'length', 'max'=>50),
            array('Name, Position, Status', 'default', 'setOnEmpty' => true, 'value' => null),
            array('Id, Name, Position, Status', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function pivotModels() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'Id' => Yii::t('app', 'ID'),
            'Name' => Yii::t('app', 'Name'),
            'Position' => Yii::t('app', 'Position'),
            'Status' => Yii::t('app', 'Status'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('Id', $this->Id, true);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('Position', $this->Position);
        $criteria->compare('Status', $this->Status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}