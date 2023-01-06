<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if ($editMode)
                Edytuj zadanie
            @else
                Dodaj zadanie
            @endif
        </h3>
        <hr class="my-2">

        @can('tasks.store')
            <div class="grid grid-cols-2 gap-2 py-3">
                <div>
                    <label for="title"> {{ __('table.headers.title') }} </label>
                </div>
                <div>
                    <x-input wire:model="task.title" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2 py-3">
                <div>
                    <label for="description">{{ __('table.headers.description') }} </label>
                </div>
                <div>
                    <x-textarea wire:model="task.description" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2 py-3">
                <div>
                    <label for="user"> {{ __('table.headers.user') }} </label>
                </div>
                <div>
                    <x-select :options="$users" option-key-value="true" wire:model="task.user_id" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2 py-3">
                <div>
                    <label for="user">{{ __('table.headers.deadline') }}</label>
                </div>
               <input class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm"
                      type="datetime-local"
                      wire:model="task.deadline"
               >
            </div>

        @endcan

        @can('tasks.change_status')
        <div class="grid grid-cols-2 gap-2 py-3">
            <div>
                <label for="user">{{ __('table.headers.status') }}</label>
            </div>
            <div>
                <x-select :options="$statuses" option-key-value="true" wire:model="task.status_id" />
            </div>
        </div>
        @endcan

        <hr class="my-2" >
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('task.index') }}" secondary class="mr-2" label="Powrót"></x-button>
            <x-button type="submit" primary label="Zapisz" spinner></x-button>
        </div>
    </form>
</div>
