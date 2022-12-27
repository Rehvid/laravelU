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

        <div class="grid grid-cols-2 gap-2 py-3">
            <div>
                <label for="title">Tytuł</label>
            </div>
            <div>
                <x-input wire:model="task.title" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2 py-3">
            <div>
                <label for="description">Description</label>
            </div>
            <div>
                <x-textarea wire:model="task.description" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2 py-3">
            <div>
                <label for="user">Użytkownik</label>
            </div>
            <div>
                <x-select :options="$users" option-key-value="true" wire:model="task.user_id" />
            </div>
        </div>


        <div class="grid grid-cols-2 gap-2 py-3">
            <div>
                <label for="user">Status</label>
            </div>
            <div>
                <x-select :options="$statuses" option-key-value="true" wire:model="task.status_id" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2 py-3">
            <div>
                <label for="user">Deadline</label>
            </div>
            <x-datetime-picker
                placeholder="Deadline"
                parse-format="YYYY-MM-DD HH:mm"
                wire:model="task.deadline"
            />
        </div>



        <hr class="my-2" >
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('task.index') }}" secondary class="mr-2" label="Powrót"></x-button>
            <x-button type="submit" primary label="Zapisz" spinner></x-button>
        </div>
    </form>
</div>
