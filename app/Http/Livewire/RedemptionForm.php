<?php

namespace App\Http\Livewire;

use App\Models\WishlistItem;
use App\Models\Redemption;
use Livewire\Component;

class RedemptionForm extends Component
{
    public $itemId;
    public $name;
    public $email;

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'itemId' => 'required|exists:wishlist_items,id'
    ];

    public function mount($itemId)
    {
        if (!$itemId) {
            throw new \Exception('No item ID provided to RedemptionForm');
        }
        $this->itemId = $itemId;
    }

    public function render()
    {
        $item = WishlistItem::find($this->itemId);
        if (!$item) {
            throw new \Exception("Item not found with ID: {$this->itemId}");
        }

        return view('livewire.redemption-form', [
            'item' => $item
        ]);
    }

    public function redeem()
    {
        $this->validate();

        $item = WishlistItem::findOrFail($this->itemId);

        if ($item->is_redeemed) {
            $this->emit('redemptionMessage', ['type' => 'error', 'message' => 'Este regalo ya ha sido reservado.']);
            return;
        }

        try {
            Redemption::create([
                'wishlist_item_id' => $this->itemId,
                'redeemer_name' => $this->name,
                'redeemer_email' => $this->email,
            ]);

            $item->update(['is_redeemed' => true]);

            $this->reset(['name', 'email']);
            $this->emit('redemptionMessage', ['type' => 'success', 'message' => '¡Regalo reservado exitosamente!']);
            $this->emit('gift-redeemed');

        } catch (\Exception $e) {
            $this->emit('redemptionMessage', ['type' => 'error', 'message' => 'Hubo un error al reservar el regalo. Por favor intenta nuevamente.']);
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
