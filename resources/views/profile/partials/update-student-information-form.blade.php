@php
    use App\Models\Role;
@endphp

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Student Profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your GPA and roles.') }}
        </p>
    </header>

    <form action="{{ route('students.update', auth()->user()->student) }}" method="POST" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="gpa" :value="__('Gpa')" />
            <x-text-input id="gpa" name="gpa" type="number" class="mt-1 block w-full" :value="old('gpa', $user->student->gpa)"
                autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('gpa')" />
        </div>

        {{-- Roles --}}
        <div>
            <x-input-label for="roles" :value="__('Roles')" />
            <select name="roles[]" id="roles" multiple class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                @foreach (Role::all() as $role)
                    <option value="{{ $role->id }}" @if ($user->student && $user->student->roles->contains('role_id', $role->id)) selected @endif>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('roles')" />
        </div>
        


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
