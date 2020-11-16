<div class="space-y-10">
    <x-selectpicker
        wire:model="state"
        label="State"
        :options="$states"
        />
    <x-selectpicker
        wire:model="city"
        label="City"
        :options="$cities"
    />
</div>
