<?php

namespace thtmorais\validators;

use Yii;
use yii\validators\Validator;
use yii\i18n\PhpMessageSource;

/**
 * Class XandValidator
 * @package thtmorais\validators
 */
class XandValidator extends Validator
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

        Yii::setAlias('@thtmorais/yii2-validators', dirname(__DIR__));

        Yii::$app->i18n->translations['thtmorais/yii2-validators'] = [
            'class' => PhpMessageSource::class,
            'basePath' => '@thtmorais/yii2-validators/src/messages'
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
            $this->addError($model, $attribute, Yii::t('thtmorais/yii2-validators', 'All or none of the specified fields must be filled.'));

            foreach ($this->fields as $field) {
                $this->addError($model, $field, Yii::t('thtmorais/yii2-validators', 'All or none of the specified fields must be filled.'));
            }
        }
    }
}
