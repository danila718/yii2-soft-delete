<?php

namespace Danila718\SoftDelete\Behaviors;

use yii\behaviors\TimestampBehavior;

/**
 * Class SoftDeleteBehavior
 *
 * ```php
 * use Danila718\SoftDelete\Behaviors\SoftDeleteBehavior;
 *
 * public function behaviors()
 * {
 *     return [
 *         SoftDeleteBehavior::className(),
 *     ];
 * }
 * ```
 *
 * @package Danila718\SoftDelete\Behaviors
 * @property $owner
 */
class SoftDeleteBehavior extends TimestampBehavior
{
    public const EVENT_BEFORE_SOFT_DELETE = 'beforeSoftDelete';
    public const EVENT_AFTER_SOFT_DELETE = 'afterSoftDelete';
    public const EVENT_BEFORE_FORCE_DELETE = 'beforeForceDelete';
    public const EVENT_AFTER_FORCE_DELETE = 'beforeForceDelete';
    public const EVENT_BEFORE_RESTORE = 'beforeRestore';
    public const EVENT_AFTER_RESTORE = 'afterRestore';

    public $deletedAtAttribute = 'deleted_at';

    public $withTimestamp = false;

    public function init()
    {
        if ($this->withTimestamp) {
            parent::init();
        }

        $this->attributes = array_merge($this->attributes, [
            static::EVENT_BEFORE_SOFT_DELETE => $this->deletedAtAttribute,
        ]);
    }
}
