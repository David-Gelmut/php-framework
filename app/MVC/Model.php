<?php

namespace App\MVC;

use ReflectionClass;
use Valitron\Validator;

class Model
{
    protected bool $timestamps = true;
    protected array $fillable = [];
    protected array $attributes = [];
    protected array $attributes_form = [];
    protected array $rules = [];
    protected array $errors = [];
    protected array $labels = [];

    protected string $table;
    private array $find_attributes = [];

    public function __construct()
    {
        $this->setTableName();
        $this->setAttributesForm();
    }

    protected function setTableName(): void
    {
        $type = new ReflectionClass(static::class);
        $shortName = $type->getShortName();
        $this->table = strtolower($shortName) . 's';
    }

    protected function setAttributesForm(): void
    {
        $this->attributes_form = request()->getData();
    }

    protected function setOnlyFillableAttributes(): void
    {
        foreach ($this->attributes_form as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $this->attributes[$key] = $value;
            }
        }
    }

    protected function setTimeStamps(): void
    {
        if ($this->timestamps) {
            $this->attributes['created_at'] = date("Y-m-d h:i:s");
            $this->attributes['updated_at'] = date("Y-m-d h:i:s");
        }
    }

    protected function setTimeStampsUpdate(): void
    {
        if ($this->timestamps) {
            $this->attributes['updated_at'] = date("Y-m-d h:i:s");
        }
    }

    public function getAttributesForm(): array
    {
        return $this->attributes_form;
    }

    public function getFillables(): array
    {
        return $this->fillable;
    }

    public function validate($rules = [], $data = [], $labels = []): bool
    {
        if (!$rules) {
            $rules = $this->rules;
        }
        if (!$data) {
            $data = $this->attributes_form;
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
            session()->set('form_errors', $this->getErrors());
            session()->set('form_data', $this->getAttributesForm());
            return false;
        }
    }

    protected function getErrors(): array
    {
        return $this->errors;
    }

    protected function prepareAttributes(): void
    {
        if (isset($this->attributes['password'])) {
            $this->attributes['password'] = password_hash($this->attributes['password'], PASSWORD_DEFAULT);
        }
    }

    protected function prepareQueryParams(): array
    {
        $this->setTimeStamps();
        $fieldKeys = array_keys($this->attributes);
        $fields = implode(',', array_map(fn($field) => "`{$field}`", $fieldKeys));
        $placeholders = implode(',', array_map(fn($field) => ":{$field}", $fieldKeys));

        return [$fields, $placeholders];
    }

    protected function prepareQueryParamsToUpdate(): string
    {
        $this->setTimeStampsUpdate();
        $output = [];
        foreach ($this->attributes as $key => $value) {
            $output [] = "`{$key}` = '{$value}'";
        }
        return implode(',', $output);
    }

    public function find(int $key): self|false
    {
        $result = db()->findOne($this->table, $key);
        if ($result) {
            $this->find_attributes = $result;
        }
        return $this;
    }

    public function findAll(): array|false
    {
        return db()->findAll($this->table);
    }

    public function findOne(mixed $value, mixed $key = 'id'): array|false
    {
        return db()->findOne($this->table, $value, $key);
    }

    public function save(): int|false
    {
        $this->setOnlyFillableAttributes();
        $this->prepareAttributes();
        $prepareQueryParams = $this->prepareQueryParams();

        $query = "insert into {$this->table} ($prepareQueryParams[0]) values ($prepareQueryParams[1])";
        db()->query($query, $this->attributes);
        return db()->getInsertID();
    }

    public function create(array $attributes): int|false
    {
        $this->attributes_form = $attributes;
        $this->save();
        return db()->getInsertID();
    }

    public function update(int $id, array $attributes): int
    {
        $this->attributes_form = $attributes;
        $this->setOnlyFillableAttributes();
        $this->prepareAttributes();
        $prepareQueryParams = $this->prepareQueryParamsToUpdate();
        $query = "update `{$this->table}` set {$prepareQueryParams} where id = {$id}";
        db()->query($query);
        return $id;
    }

    public function updateForce(int $id, array $attributes): int
    {
        $fillable = array_flip($this->getFillables());
        foreach ($fillable as $key => $value) {
            $fillable[$key] = null;
        }
        return $this->update($id, array_merge($fillable, $attributes));

    }

    public function remove(): bool|int
    {
        if (isset($this->find_attributes['id']))
            $id = $this->find_attributes['id'];
        if (isset($id)) {
            $query = "delete from {$this->table} where `id` = {$id} limit 1";
            db()->query($query);
            return $id;
        } else {
            return false;
        }
    }
}