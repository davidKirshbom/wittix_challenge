<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerService
{
    public function create(array $data)
    {
        self::validate($data);

        return Customer::create($data);
    }
    public function update(Customer $customer, array $data)
    {
        self::validate($data);
        $customer->update($data);
        return $customer;
    }
    public function delete(Customer $customer)
    {
        $customer->delete();
    }
    public function find(int $id)
    {
        return Customer::findOrFail($id);
    }
    public function all()
    {
        return Customer::all();
    }

    public static function validate(array $data)
    {

        $validator = Validator::make($data, [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
            'user_id' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
        return $validator;
    }
}
