<?php

namespace App\Services\User;

use App\Exceptions\CustomExceptionWithMessage;
use App\Models\Item;
use Carbon\Carbon;

class ItemService
{
    public function __construct()
    {
        $this->model = new Item();
    }


    public function createMany($items, $orderID)
    {
        $itemsArray = $this->prepareOrderItems($items, $orderID);

        $this->model::query()->insert($itemsArray);

        return $itemsArray;
    }

    private function prepareOrderItems($items, $orderID)
    {
        $productVariantsIDs = collect($items)->pluck('product_variant_id');
        $productVariants = (new ProductVariantService())->getByIDs($productVariantsIDs);

        $itemsArray = [];
        $created_at = Carbon::now()->toDateTimeString();

        foreach ($items as $item)
        {
            $product_variant = $productVariants->get($item['product_variant_id']);

            if ($product_variant->amount < $item['amount'])
                throw new CustomExceptionWithMessage('no enough amount from ' . $item['product_variant_id']);

            if(is_array($product_variant->price))
                $price = $product_variant->price['price_after_discount'];
            else
                $price = $product_variant->price;

            $itemsArray[] = [
                'order_id' => $orderID,
                'product_variant_id' => $item['product_variant_id'],
                'amount' => $item['amount'],
                'total_price' => $price * $item['amount'],
                'created_at' => $created_at
            ];
        }

        return $itemsArray;
    }

    public function configItems($order)
    {
        $orderItems = $order->items;
        $productVariantsIDs = $orderItems->pluck('product_variant_id')->toArray();

        $productVariantService = new ProductVariantService();

        $productVariants = $productVariantService->getByIDs($productVariantsIDs);
        $productVariantService->configProductVariants($productVariants);

        foreach ($orderItems as $orderItem)
            $orderItem->productVariant =
                $productVariants->get($orderItem->product_variant_id);
    }



}
