<?php

namespace App\Http\Livewire;

use App\Models\WishlistItem;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class WishlistManager extends Component
{
    public $name;
    public $description;
    public $editingId;
    public $editingName;
    public $editingDescription;
    public $search = '';
    public $itemToDelete = null;

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'nullable',
    ];

    protected $editRules = [
        'editingName' => 'required|min:3',
        'editingDescription' => 'nullable',
    ];

    public function render()
    {
        return view('livewire.wishlist-manager', [
            'items' => $this->items
        ]);
    }

    public function create()
    {
        try {
            $validated = $this->validate($this->rules);
            Log::info('Validation passed', $validated);

            $item = WishlistItem::create([
                'name' => $this->name,
                'description' => $this->description
            ]);

            Log::info('Item created', ['item' => $item]);

            $this->reset(['name', 'description']);
            session()->flash('message', 'Item created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error creating wishlist item', [
                'errors' => $e->errors(),
                'name' => $this->name,
                'description' => $this->description
            ]);
            session()->flash('error', 'Validation failed: ' . implode(', ', array_map(function($errors) {
                return implode(', ', $errors);
            }, $e->errors())));
        } catch (\Exception $e) {
            Log::error('Error creating wishlist item', [
                'error' => $e->getMessage(),
                'name' => $this->name,
                'description' => $this->description
            ]);
            session()->flash('error', 'Failed to create item: ' . $e->getMessage());
        }
    }

    public function startEdit($id)
    {
        $item = WishlistItem::findOrFail($id);
        $this->editingId = $id;
        $this->editingName = $item->name;
        $this->editingDescription = $item->description;
    }

    public function update()
    {
        $this->validate($this->editRules);

        $item = WishlistItem::findOrFail($this->editingId);
        $item->update([
            'name' => $this->editingName,
            'description' => $this->editingDescription,
        ]);

        $this->reset(['editingId', 'editingName', 'editingDescription']);
        session()->flash('message', 'Item updated successfully.');
    }

    public function confirmDelete($id)
    {
        $this->itemToDelete = $id;
    }

    public function cancelDelete()
    {
        $this->itemToDelete = null;
    }

    public function delete($id)
    {
        $item = WishlistItem::findOrFail($id);
        $item->update(['active' => false]);
        $this->itemToDelete = null;
        session()->flash('message', 'Item deleted successfully.');
    }

    public function getItemsProperty()
    {
        return WishlistItem::where('active', true)
            ->where(function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
