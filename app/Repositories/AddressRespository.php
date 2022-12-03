<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRespository
{
    public function create(array $data): Address
    {
        return Address::create($data);
    }

    public function removeDefault(): bool
    {
        return Address::where('id', '!=', '')->update([
            'default' => 0
        ]);
    }

    public function getDefaultAddress(): ?Address
    {
        return Address::where('default', '=', '1')->first();
    }
}
