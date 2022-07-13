# Yii2 Soft Delete

Это расширение реализует возможности "Soft delete" для Yii2.

## Установка

1. Добавить репозиторий в `composer.json`
```json
"repositories":[
    {
        "type": "vcs",
        "url": "https://github.com/danila718/yii2-soft-delete.git"
    }
]
```
2. Запустить:
```
composer require danila718/yii2-soft-delete:dev-master
```

## Использование

В классе модели `yii\db\ActiveRecord`:

1. Добавить столбец `deleted_at` (int) и индекс для него в БД
2. Добавить трейт `use SoftDelete;`
3. Добавить поведение `SoftDeleteBehavior` в метод behaviors

```php
class Model extends \yii\db\ActiveRecord
{
    use SoftDelete;

    public function behaviors()
    {
        return [
            SoftDeleteBehavior::class,
        ];
        /**
         * В варианте ниже поведение будет зазполнять поля created_at, updated_at, deleted_at, 
         * т.к. SoftDeleteBehavior расширен от TimestampBehavior и при флаге withTimestamp = true
         * будет также запускать методы родителя
         */ 
        return [
            [
                'class' => SoftDeleteBehavior::class,
                'withTimestamp' => true,
            ]
        ];
    }
}
```

## API

### ActiveRecord (с трейтом SoftDelete)

- метод find() возвращает объект `softDelete\ActiveQuery`
- новые методы `findWithTrashed()`, `findOnlyTrashed()`, `findOneWithTrashed()`, `findAllWithTrashed()`, `findOneOnlyTrashed()`, `findAllOnlyTrashed()`, `isTrashed()`
- добавлен приватный флаг `private $forceDelete = false;` 
- метод `delete()` по умолчанию выполнит soft delete, если `$forceDelete == false`, добавлены методы `softDelete()`, `restore()`, `forceDelete()` - реальное удаление 

### softDelete\ActiveQuery

- новые методы `withTrashed()`, `withoutTrashed()`, `onlyTrashed()`
