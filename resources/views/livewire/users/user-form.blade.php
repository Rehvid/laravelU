<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if ($editMode)
                Przypisz zespół
            @endif

        </h3>
        <hr class="my-2">

       <div class="grid grid-cols-2 gap-2 py-3">
            <div>
                <label for="user">Zespoły</label>
            </div>
            <div>
                <x-select :options="$teams" option-key-value="true" wire:model="user.team_id" />
            </div>
        </div>
        <hr class="my-2" >
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('users.index') }}" secondary class="mr-2" label="Powrót"></x-button>
            <x-button type="submit" primary label="Zapisz" spinner></x-button>
        </div>
    </form>
</div>
