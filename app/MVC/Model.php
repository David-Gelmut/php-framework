<?php

namespace App\MVC;

use ReflectionClass;
use Valitron\Validator;

class Model
{
    protected array $fillable = [];
    protected array $attributes = [];
    protected array $rules = [];
    protected array $errors = [];
    protected array $labels = [];

    protected string $table = '';

    public function __construct()
    {
        $this->getTableName();
        $this->getData();
    }

    private function getData(): void
    {
        $data = request()->getData();
        foreach ($this->fillable as $field) {
            if (isset($data[$field])) {
                $this->attributes[$field] = $data[$field];
            }
        }
    }

    private function getTableName(): void
    {
        $type = new ReflectionClass(static::class);
        $shortName = $type->getShortName();
        $this->table = strtolower($shortName) . 's';
    }

    public function validate($rules = [], $data = [], $labels = []): bool
    {
        if (!$rules) {
            $rules = $this->rules;
        }
        if (!$data) {
            $data = $this->attributes;
        }

        if (!$labels) {
            $labels = $this->labels;
        }

        Validator::langDir(LANG_DIR . '/validator/lang');
        Validator::lang('ru');
        $validator = new Validator($data);
        $validator->rules($rules);
        $validator->labels($labels);
        if ($validator->validate()) {
            return true;
        } else {
            $this->errors = $validator->errors();
            return false;
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    /*public function create(array $data)
    {
        db()->create($this->table, $data);
    }*/

    public function findAll(): array|false
    {
        return db()->findAll($this->table);
    }

    public function findOne(mixed $value, mixed $key = 'id'): array|false
    {
        return db()->findOne($this->table, $value, $key);
    }
}