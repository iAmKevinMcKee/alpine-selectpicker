<div class="space-y-10">
    <form wire:submit.prevent="submit" class="space-y-10">
        <x-selectpicker
            wire:model="state"
            label="State"
            options="states"
        />
        <x-selectpicker
            wire:model="city"
            label="City"
            options="cities"
        />
        <button type="submit">Click Me</button>
    </form>
</div>
