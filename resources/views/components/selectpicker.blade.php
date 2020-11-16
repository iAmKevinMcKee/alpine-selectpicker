@props([
    'label' => 'Default',
    'placeholder' => 'Search...',
    'options' => null,
])

<div class="space-y-1">
    <div
        x-data="{
            value: @entangle($attributes->wire('model')),
            options: {{ $options }},
            search: '',
            open: false,
            optionVisible(text) {
                if(! this.search) {
                    return true;
                }
                return text.toLowerCase().includes(this.search.toLowerCase());
            },
            clickAway() { this.search = this.options[this.value]; this.open = false; }
        }"
        x-cloak
        x-init="
            search = options[value];
            $watch('value', () => {
                search = options[value];
            });
        "
        class="relative space-y-1">
        <div
            x-on:click="open = true"
            x-on:click.away="clickAway()">
            <label for="{{\Illuminate\Support\Str::snake($label)}}" class="block text-sm font-medium leading-5 text-gray-700">{{$label}}</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input
                    x-model="search"
                    x-on:click="search = ''"
                    id="{{\Illuminate\Support\Str::snake($label)}}" class="form-input block w-full pr-10 sm:text-sm sm:leading-5" placeholder="{{$placeholder}}">
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </div>
        </div>
{{--        <template x-for="(key, option) in Object.entries(options)">--}}
{{--            <div value="key" x-text="option"></div>--}}
{{--        </template>--}}

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
            x-show="open"
            x-transition:leave="transition ease-in duration-50"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute mt-1 w-full rounded-md bg-white shadow-lg z-10">
            <ul tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-item-3" class="max-h-60 rounded-md py-1 text-base leading-6 shadow-xs overflow-auto focus:outline-none sm:text-sm sm:leading-5">
                <!--
                  Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                  Highlighted: "text-white bg-indigo-600", Not Highlighted: "text-gray-900"
                -->
                <template x-for="option in Object.entries(options)" :key="option[0]">
                    <li
                        x-show="optionVisible(option[1])"
                        x-on:click="value = option[0]"
                        id="listbox-option-0" role="option" class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9 hover:text-white hover:bg-indigo-600 focus:bg-indigo-600">
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
                            class="text-indigo-300 absolute inset-y-0 right-0 flex items-center pr-4">
                            <!-- Heroicon name: check -->
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </li>
                </template>


{{--                <li--}}
{{--                    wire:click="$set('{{$attributes->wire('model')->value()}}', 'MS')"--}}
{{--                    x-show="optionVisible('Mississippi')"--}}
{{--                    id="listbox-option-0" role="option" class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9">--}}
{{--                    <!-- Selected: "font-semibold", Not Selected: "font-normal" -->--}}
{{--                    <span class="font-normal block truncate" x-bind:class="{ 'font-semibold': value === 'MS'}">--}}
{{--                        Mississippi--}}
{{--                    </span>--}}

{{--                    <!----}}
{{--                      Checkmark, only display for selected option.--}}

{{--                      Highlighted: "text-white", Not Highlighted: "text-indigo-600"--}}
{{--                    -->--}}

{{--                    <span--}}
{{--                        x-show="value === 'MS'"--}}
{{--                        class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">--}}
{{--                        <!-- Heroicon name: check -->--}}
{{--                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">--}}
{{--                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />--}}
{{--                        </svg>--}}
{{--                    </span>--}}
{{--                </li>--}}
{{--                <li--}}
{{--                    wire:click="$set('{{$attributes->wire('model')->value()}}', 'TX')"--}}
{{--                    x-show="optionVisible('Texas')"--}}
{{--                    id="listbox-option-0" role="option" class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9">--}}
{{--                    <!-- Selected: "font-semibold", Not Selected: "font-normal" -->--}}
{{--                    <span class="font-normal block truncate" x-bind:class="{ 'font-semibold': value === 'TX'}">--}}
{{--                        Texas--}}
{{--                    </span>--}}

{{--                    <!----}}
{{--                      Checkmark, only display for selected option.--}}

{{--                      Highlighted: "text-white", Not Highlighted: "text-indigo-600"--}}
{{--                    -->--}}
{{--                    <span--}}
{{--                        x-show="value === 'TX'"--}}
{{--                        class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">--}}
{{--                        <!-- Heroicon name: check -->--}}
{{--                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">--}}
{{--                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />--}}
{{--                        </svg>--}}
{{--                    </span>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
</div>
