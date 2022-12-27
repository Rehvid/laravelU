<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if ($editMode)
                Edytuj
            @else
                Dodaj nowy zespoł
            @endif
        </h3>
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div>
                <label for="name">Nazwa</label>
            </div>
            <div>
                <x-input wire:model="team.name" />
            </div>
        </div>
        <hr class="my-2" >
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('team.index') }}" secondary class="mr-2" label="Powrót"></x-button>
            <x-button type="submit" primary label="Zapisz" spinner></x-button>
        </div>
    </form>
</div>