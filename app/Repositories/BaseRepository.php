<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseRepository
{
    protected $model;

    /**
     * Method to get data
     *
     * @param  array  $cond Where clause condition
     */
    public function get(array $cond = []): Collection
    {
        $model = $this->wheremapper($cond, $this->model);

        return $model->get();
    }

    /**
     * Method to get ordered data
     *
     * @param  string  $ref Column order
     * @param  string  $order Order direction
     * @param  array  $cond Where clause condition
     */
    public function getOrderBy(string $ref, string $order = 'ASC', array $cond = []): Collection
    {
        $model = $this->wheremapper($cond, $this->model);

        return $model->orderBy($ref, $order)->get();
    }

    /**
     * Method getOrderByLimit
     *
     * @param  string  $ref [explicite description]
     * @param  string  $order [explicite description]
     * @param  int  $limit [explicite description]
     * @param  array  $cond [explicite description]
     */
    public function getOrderByLimit(string $ref, string $order = 'ASC', int $limit = 1, array $cond = []): Collection
    {
        $model = $this->wheremapper($cond, $this->model);

        return $model->limit($limit)->orderBy($ref, $order)->get();
    }

    /**
     * Method find
     *
     * @param  int  $primary [explicite description]
     * @return void
     */
    public function find(int $primary)
    {
        return $this->model->find($primary);
    }

    /**
     * Method findWhere
     *
     * @param  array  $cond [explicite description]
     * @return void
     */
    public function findWhere(array $cond = [])
    {
        $model = $this->wheremapper($cond, $this->model);

        return $model->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Method updateOrCreate
     *
     * @param  array  $find [explicite description]
     * @param  array  $data [explicite description]
     * @return void
     */
    public function updateOrCreate(array $find, array $data)
    {
        return $this->model->updateOrCreate($find, $data);
    }

    /**
     * Method update
     *
     * @param  array  $find [explicite description]
     * @param  array  $data [explicite description]
     * @return void
     */
    public function update(array $find, array $data)
    {
        return $this->wheremapper($find, $this->model)->update($data);
    }

    /**
     * Method delete
     *
     * @param  array  $find [explicite description]
     */
    public function delete(array $find)
    {
        return $this->wheremapper($find, $this->model)->delete();
    }

    /**
     * Method destroy
     *
     * @param  array  $find [explicite description]
     */
    public function destroy(array $find): object
    {
        return $this->wheremapper($find, $this->model)->destroy();
    }

    /**
     * Method restore
     *
     * @param  array  $find [explicite description]
     */
    public function restore(array $find): object
    {
        $model = $this->model->withTrashed();

        return $this->wheremapper($find, $model)->restore();
    }

    /**
     * Method withTrashed
     */
    public function withTrashed(): object
    {
        $this->model = $this->model->withTrashed();

        return $this;
    }

    /**
     * Method removeScopes
     *
     * @param  string|array  $scope [explicite description]
     */
    public function removeScopes(string|array $scope = null): object
    {
        if (is_null($scope)) {
            $this->model = $this->model->withoutGlobalScopes();
        } else {
            $this->model = $this->model->withoutGlobalScope($scope);
        }

        return $this;
    }

    /**
     * Get Model
     */
    public function raw()
    {
        return $this->model;
    }

    private function wheremapper(array $cond, $model)
    {
        foreach ($cond as $key => $value) {
            if ($value instanceof \Closure) {
                $model = $model->where(function ($qry) use ($value) {
                    $value($qry);
                });

                continue;
            }

            if (is_numeric($key)) {
                $model = $model->whereRaw($value);

                continue;
            }

            $column = explode(' ', $key);
            if (count($column) > 1) {
                if ($this->containOperator(['IN', 'NOT IN'], $key)) {
                    if (strpos('NOT IN', $key)) {
                        $model = $model->whereNotIn($column[0], $value);
                    } else {
                        $model = $model->whereIn($column[0], $value);
                    }

                    continue;
                }

                $operator = str_replace($column[0].' ', '', $key);
                $model = $model->where($column[0], $operator, $value);
            } else {
                $model = $model->where($key, $value);
            }
        }

        return $model;
    }

    private function containOperator($words, $sentence): bool
    {
        foreach ($words as $word) {
            if (Str::contains($sentence, $word)) {
                return true;
            }
        }

        return false;
    }
}
