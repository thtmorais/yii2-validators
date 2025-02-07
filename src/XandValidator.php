<?php

namespace thtmorais\validators;

use Yii;

/**
 * Class XandValidator
 * @package thtmorais\validators
 */
class XandValidator extends \yii\validators\Validator
{
    /**
     * @var array
     */
    public $fields;

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();

        Yii::setAlias('@validators', dirname(__DIR__));

        Yii::$app->i18n->translations['validators'] = [
            'class' => '\yii\i18n\PhpMessageSource',
            'basePath' => '@validators/src/messages'
        ];
    }

    /**
     * @param $model
     * @param $attribute
     * @return void
     */
    public function validateAttribute($model, $attribute)
    {
        $values = [];

        foreach ($this->fields as $field) {
            $values[] = $model->$field;
        }

        $filledCount = count(array_filter($values, function ($value) {
            return !empty($value);
        }));

        if ($filledCount != 0 && $filledCount != count($this->fields)) {
            $this->addError($model, $attribute, Yii::t('validators', 'All or none of the specified fields must be filled.'));

            foreach ($this->fields as $field) {
                $this->addError($model, $field, Yii::t('validators', 'All or none of the specified fields must be filled.'));
            }
        }
    }
}
