<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseService
{
    protected $repo;

    protected $connection;

    public function __construct()
    {
        $this->connection = config('database.default');
    }

    public function all()
    {
        return $this->repo->get();
    }

    /**
     * Method beginTransaction
     *
     * @param  array|string  $connection [explicite description]
     */
    public function beginTransaction(array|string $connection = null): void
    {
        $conn = $connection ?? $this->connection;
        if (is_array($conn)) {
            foreach ($conn as $con) {
                DB::connection($con)->beginTransaction();
            }
        } else {
            DB::connection($conn)->beginTransaction();
        }
    }

    /**
     * Method commit
     *
     * @param  array|string  $connection [explicite description]
     */
    public function commit(array|string $connection = null): void
    {
        $conn = $connection ?? $this->connection;
        if (is_array($conn)) {
            foreach ($conn as $con) {
                DB::connection($con)->commit();
            }
        } else {
            DB::connection($conn)->commit();
        }
    }

    /**
     * Method rollBack
     *
     * @param  array|string  $connection [explicite description]
     */
    public function rollBack(array|string $connection = null): void
    {
        $conn = $connection ?? $this->connection;
        if (is_array($conn)) {
            foreach ($conn as $con) {
                DB::connection($con)->rollBack();
            }
        } else {
            DB::connection($conn)->rollBack();
        }
    }
}
