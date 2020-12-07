@props([
    'label' => 'Label',
    'placeholder' => null,
    'options',
    'value' => null,
    'name',
])

<div x-data="{ isOpen: false, options: {{$options}}, value: {{$value}} }">
    <label id="listbox-label" class="block text-sm font-medium text-gray-700">
        {{$label}}
    </label>
<input name="{{$name}}" x-bind:value="value" class="hiddenwsdxdds,k" />
    <div
        x-on:click.away="isOpen = false"
        class="mt-1 relative">
        <button
            x-on:click="isOpen = true"
            x-on:keydown.enter="isOpen = true"
            type="button" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label" class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <span class="block truncate">
                {{$placeholder}}
            </span>
            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <!-- Heroicon name: selector -->
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>
        <div
            x-show="isOpen"
            class="absolute mt-1 w-full rounded-md bg-white shadow-lg">
            <template x-for="option in Object.entries(options)" :key="option[0]">
            <ul tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-item-3" class="max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                <!--
                  Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                  Highlighted: "text-white bg-indigo-600", Not Highlighted: "text-gray-900"
                -->
                <li
                    x-on:click="value = option[0]"
                    id="listbox-option-0" role="option" class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9">
                    <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                    <span class="font-normal block truncate" x-text="option[1]"></span>

                    <!--
                      Checkmark, only display for selected option.

                      Highlighted: "text-white", Not Highlighted: "text-indigo-600"
                    -->
                    <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                        <!-- Heroicon name: check -->
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </li>

                <!-- More options... -->
            </ul>
            </template>
        </div>
    </div>
</div>