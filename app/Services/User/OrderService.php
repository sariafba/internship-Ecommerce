<?php

namespace App\Services\User;

use App\Exceptions\CustomExceptionWithMessage;
use App\Exceptions\NotFoundException;
use App\Http\Resources\User\Order\OrderCollection;
use App\Http\Resources\User\Order\OrderResource;
use App\Models\Order;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class OrderService extends BaseService
{
    public function __construct(Order $model)
    {
        $this->model = $model;
        $this->user = auth('users')->user();
        $this->itemService = new ItemService();
    }


    public function getAll($filters = [])
    {
        return new OrderCollection($this->user->orders()->with('city')->get());
    }

    public function getOne($id)
    {
        $order = $this->user->orders()->with(['city','items'])->where('id', $id)->first();

        if (!$order)
            throw new NotFoundException();

        $this->itemService->configItems($order);

        return new OrderResource($order);
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();

            $order = $this->createOrder($data);

            $items = $this->itemService->createMany($data['items'], $order->id);

            $this->updateOrder($order, [
                'total_price' => collect($items)->sum('total_price')
            ]);

            DB::commit();
            return new OrderResource($order->fresh());
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    private function createOrder($data)
    {
        return $this->user->orders()->create([
            'city_id' => $data['city_id'] ?? $this->user->city_id,
            'name' => $data['name'] ?? $this->user->name,
            'phone' => $data['phone'] ?? $this->user->phone,
            'address' => $data['address'] ?? $this->user->address,
        ]);
    }
    private function updateOrder($order, $data)
    {
        $order->update($data);
    }
}
