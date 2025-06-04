<?php

namespace App\Http\Livewire;

use App\Models\WishlistItem;
use Livewire\Component;

class WishlistDisplay extends Component
{
    public $searchEmail = '';
    public $redeemedItems = [];
    public $selectedItemId = null;
    public $checkedRedemptions = false;
    public $search = '';

    protected $listeners = [
        'giftRedeemed' => '$refresh',
        'redemptionMessage' => 'handleRedemptionMessage',
        'gift-redeemed' => 'handleGiftRedeemed'
    ];

    public function render()
    {
        $query = WishlistItem::query()->where('active', true);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.wishlist-display', [
            'items' => $query->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function checkRedemptions()
    {
        $this->validate([
            'searchEmail' => 'required|email'
        ]);

        $this->checkedRedemptions = true;

        $this->redeemedItems = WishlistItem::where('active', true)
            ->whereHas('redemption', function($query) {
                $query->where('redeemer_email', $this->searchEmail);
            })->get();
    }

    public function handleModalClose()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function handleRedemptionMessage($data)
    {
        // The message display is handled by AlpineJS in the blade template
        if ($data['type'] === 'success') {
            session()->flash('message', 'Regalo reservado exitosamente.');
            session()->flash('message-type', 'success');
            $this->handleGiftRedeemed();
        } else {
            session()->flash('message', 'Falló la reserva del regalo. Por favor, inténtalo de nuevo.');
            session()->flash('message-type', 'error');
        }
    }

    public function handleGiftRedeemed()
    {
        $this->selectedItemId = null;
        $this->dispatchBrowserEvent('gift-redeemed');
        $this->emit('$refresh');
    }

    public function selectItem($itemId)
    {
        $this->selectedItemId = $itemId;
    }
}
