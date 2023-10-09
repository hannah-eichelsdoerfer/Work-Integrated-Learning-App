<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('projects.update', $project->id) }}">
        @csrf
        @method('PUT') <!-- Use PUT method for updating -->

        <!-- Title -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Title')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="title" :value="$project->title"
                autofocus />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Contact Name and Email Side by Side -->
        <div class="mt-4 flex items-center justify-between gap-2">
            {{-- Contact Name --}}
            <div>
                <x-input-label for="contact_name" :value="__('Contact Name')" />
                <x-text-input id="contact_name" class="block mt-1 w-full" type="text" name="contact_name"
                    :value="old('contact_name') ?? $project->contact_name" />
                <x-input-error :messages="$errors->get('contact_name')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="contact_email" :value="__('Contact Email')" />
                <x-text-input id="contact_email" class="block mt-1 w-full" type="email" name="contact_email"
                    :value="old('contact_email') ?? $project->contact_email" />
                <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
            </div>
        </div>

        {{-- Description --}}
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" class="block mt-1 w-full" name="description" rows="5">{{ $project->description }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        {{-- Number of students --}}
        <div class="mt-4">
            <x-input-label for="num_students_needed" :value="__('Number of Students')" />
            <x-text-input id="num_students_needed" class="block mt-1 w-full" type="number" name="num_students_needed"
                :value="$project->num_students_needed" />
            <x-input-error :messages="$errors->get('num_students_needed')" class="mt-2" />
        </div>

        {{-- Trimester and Year inline --}}
        <div class="mt-4 flex items-center justify-between gap-2">
            {{-- Trimester --}}
            <div class="flex-1">
                <x-input-label for="trimester" :value="__('Trimester')" />
                <select id="trimester"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    name="trimester">
                    <option value="1" {{ $project->trimester == 1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ $project->trimester == 2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{ $project->trimester == 3 ? 'selected' : '' }}>3</option>
                </select>
                <x-input-error :messages="$errors->get('trimester')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="year" :value="__('Year')" />
                <x-text-input id="year" class="block mt-1 w-full" type="number" name="year"
                    :value="$project->year" />
                <x-input-error :messages="$errors->get('year')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
