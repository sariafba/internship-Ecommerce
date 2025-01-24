<?php

namespace App\Services\User;

use App\Models\ProductVariant;

class ProductVariantService
{

    public function getByIDs($ids)
    {
        return ProductVariant::query()
            ->with('product.images')
            ->whereIn('id', $ids)
            ->get()->keyBy('id');
    }

    public function configProductVariants($productVariants = []): void
    {
        $attributes_values_IDs = $this->getAttributesAndValuesIDs($productVariants);

        $attributes = (new AttributeService())->getByIDs($attributes_values_IDs['attributesIDs']);
        $attributesValues = (new AttributeValueService())->getByIDs($attributes_values_IDs['valuesIDs']);

        foreach ($productVariants as $productVariant)
            $this->mapAttributesAndValues($productVariant, $attributes, $attributesValues);
    }

    private function mapAttributesAndValues($productVariant, $attributes, $attributesValues): void
    {
        $lang = request()->header('lang') ?: '';
        $attributes_values = [];

        foreach ($productVariant->attributes_values as $key => $value)
        {
            $att = $attributes->get($key);
            $val = $attributesValues->get($value);

            $attributes_values[$att->getTranslation('name', $lang)] = $val->getTranslation('name', $lang);
        }

        $productVariant->attributes_values = $attributes_values;

        if ($productVariant->product->minimum_amount >= $productVariant->amount)
            $productVariant->remaining_amount = $productVariant->amount;
    }

    private function getAttributesAndValuesIDs($productVariants): array
    {
        $attributesIDs = [];
        $valuesIDs = [];

        foreach($productVariants as $productVariant)
        {
            $attributes_values = json_decode($productVariant->attributes_values, true);
            $productVariant->attributes_values = $attributes_values; //decode attributes_values

            $attributesIDs = array_merge(array_keys($attributes_values), $attributesIDs);
            $valuesIDs = array_merge(array_values($attributes_values), $valuesIDs);
        }

        $attributesIDs = array_unique($attributesIDs);
        $valuesIDs = array_unique($valuesIDs);

        return [
            'attributesIDs' => $attributesIDs,
            'valuesIDs' => $valuesIDs
        ];
    }










}
