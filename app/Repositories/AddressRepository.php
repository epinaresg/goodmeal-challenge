<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository
{
    public function create(array $data): Address
    {
        return Address::create($data);
    }

    public function update(Address $address, array $data): Address
    {
        $address->update($data);
        return $address;
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

    public function byId(string $id): ?Address
    {
        return Address::find($id);
    }
}
