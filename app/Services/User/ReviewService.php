<?php

namespace App\Services\User;

use App\Exceptions\CustomExceptionWithMessage;
use App\Models\Review;
use App\Services\BaseService;

class ReviewService extends BaseService
{
    public function __construct(Review $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        $user = auth('users')->user();

        $review = $user->reviews()->where('product_id', $data['product_id'])->first();

        if(!$review)
        {
            $data['user_id'] = $user->id;

            return parent::create($data);
        }
        else
        {
            $review->update([
                'rate' => $data['rate'],
            ]);

            return $review;
        }
    }

    public function delete($id)
    {
        $user = auth('users')->user();

        $review = $user->reviews()->where('id', $id)->first();

        if(!$review)
            throw new CustomExceptionWithMessage('not your review');

        else
        {
            $review->delete();

            return true;
        }
    }


}
