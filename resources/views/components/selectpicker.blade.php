@props([
    'label' => 'Default',
    'placeholder' => 'Search...',
    'options' => null,
])


<div class="space-y-1">
    <div
        x-data="{
            value: @entangle($attributes->wire('model')),
            highlighted: '',
            options: {{ $options }},
            search: '',
            isOpen: false,
            filteredValues() {
                if(this.search) {
                    return Object.entries(this.options).filter(option => option[1].toLowerCase().includes(this.search.toLowerCase()));
                }
                return Object.entries(this.options);
            },
            open() {
                this.isOpen = true;
                if(! this.value) {
                    this.highlighted = this.filteredValues()[0][0]
                } else {
                    this.highlighted = this.value;
                }
            },
            close() {
                this.isOpen = false;
                this.highlighted = this.value;
                if(this.value == null) { this.search = ''; }
                else { this.search = this.options[this.value]; }
                document.activeElement.blur(); // this needs to be updated
            },
            pressEnter() {
                if(this.isOpen) {
                    this.value = this.highlighted;
                    this.close();
                } else {
                    this.open();
                }
            },
            next() {
                let index = this.filteredValues().findIndex(option => option[0] === this.highlighted);
                if(index + 1 < this.filteredValues().length) {
                    console.log(this.filteredValues()[index + 1][0]);
                    this.highlighted = this.filteredValues()[index + 1][0];
                    console.log(this.highlighted);
                }
            },
            previous() {
                let index = this.filteredValues().findIndex(option => option[0] === this.highlighted);
                if(index !== 0) {
                    this.highlighted = this.filteredValues()[index - 1][0];
                }
            }
        }"
        x-cloak
        x-init="
            search = options[value];
            highlighted = value;
            if(value == null) {
                search = '';
            }
            $watch('value', () => {
                search = options[value];
            });
        "
        class="relative space-y-1">
        Value: <span x-text="value"></span><br/>
        Highlighted: <span x-text="highlighted"></span>
        <div
            x-on:click="open()"
            x-on:click.away="close()">
            <label for="{{\Illuminate\Support\Str::snake($label)}}" class="block text-sm font-medium leading-5 text-gray-700">{{$label}}</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input
                    x-model="search"
                    wire:key="{{$attributes->wire('model')->value}}"
                    x-on:click="search = ''"
                    x-on:keydown.enter="pressEnter()"
                    x-on:keydown.escape="close()"
                    x-on:keydown.arrow-down.prevent="next()"
                    x-on:keydown.arrow-up.prevent="previous()"
                    id="{{\Illuminate\Support\Str::snake($label)}}" class="form-input block w-full pr-10 sm:text-sm sm:leading-5" placeholder="{{$placeholder}}">
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </div>
        </div>

        <!--
          Select popover, show/hide based on select state.

          Entering: ""
            From: ""
            To: ""
          Leaving: "transition ease-in duration-100"
            From: "opacity-100"
            To: "opacity-0"
        -->
        <div
            x-show="isOpen"
            x-transition:leave="transition ease-in duration-50"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute mt-1 w-full rounded-md bg-white shadow-lg z-10">
            <ul tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-item-3" class="text-gray-900 max-h-60 rounded-md py-1 text-base leading-6 shadow-xs overflow-auto focus:outline-none sm:text-sm sm:leading-5">
                <!--
                  Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                  Highlighted: "text-white bg-indigo-600", Not Highlighted: "text-gray-900"
                -->
                <template x-for="option in filteredValues()" :key="option[0]">
                    <li
                        x-on:click="value = option[0]"
                        @mouseenter="highlighted = option[0]"
                        id="listbox-option-0" role="option"
                        x-bind:class="{ 'text-white bg-indigo-600': highlighted === option[0]}"
                        class="cursor-default select-none relative py-2 pl-3 pr-9 focus:bg-indigo-600">
                        <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                        <span
                            x-text="option[1]"
                            x-bind:class="{ 'font-semibold': value === option[0]}" class="font-normal block truncate" >
                        </span>

                        <!--
                          Checkmark, only display for selected option.

                          Highlighted: "text-white", Not Highlighted: "text-indigo-600"
                        -->

                        <span
                            x-show="value === option[0]"
                            class="text-white absolute inset-y-0 right-0 flex items-center pr-4"
                            x-bind:class="{ 'text-indigo-600': highlighted !== option[0]}">
                            <!-- Heroicon name: check -->
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</div>
