<?php

namespace App\Repositories\Payments;

use App\Models\Payments\Payment;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentsRepository extends Repository
{
    /**
     * @param Payment $payment
     */
    public function __construct(Payment $payment)
    {
        $this->model = $payment;
    }

    /**
     * @param array $filters
     * @param bool $isAll
     * @return Collection|array|LengthAwarePaginator
     */
    public function findBy(array $filters, bool $isAll = false): Collection|array|LengthAwarePaginator
    {
        $data = $this->model->orderBy('id', $this->ordering);

        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $data->where('user_id', $filters['user_id']);
        }

        if (isset($filters['status']) && !empty($filters['status'])) {
            $data->where('status', $filters['status']);
        }

        if ($isAll) {
            return $data->get();
        }

        return $data->paginate($this->pagination);
    }
}
