<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    {{-- Industry Partner Projects --}}
    <div class="flex justify-between items-center mb-10">
        <h3 class="text-lg font-semibold text-gray-800 leading-tight">Created Projects</h3>
        <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-project')">
            {{ __('Create New Project') }}
        </x-secondary-button>
    </div>
    <div class="space-y-5">
        @forelse ($projects as $project)
            <div class="border border-gray-300 rounded-lg cursor-pointer p-4 flex justify-between items-center hover:shadow-md transition duration-300 transform hover:scale-105">
                <div>
                    <a href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a>
                </div>
                <div class="flex justify-end">
                    <x-secondary-button class="mr-2">
                        <a href="{{ route('projects.edit', $project) }}">Edit</a>
                    </x-secondary-button>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-danger-button class="mr-2"><x-heroicon-o-trash />Delete</x-danger-button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500 italic">You have not created any projects yet.</p>
        @endforelse
    </div>


    {{-- Modal for Creating a New Project --}}
    <x-modal name="create-project" :show="$errors->isNotEmpty()" focusable>
        {{-- check if industry partner is approved --}}
        @if (auth()->user()->industryPartner->approved == 0)
            <div class="p-6">
                <p class="text-xl font-semibold text-gray-800 leading-tight">Your account is not approved yet.</p>
                <p class="text-xl font-semibold text-gray-800 leading-tight">Please wait for a teacher to approve your
                    account.</p>
            </div>
        @else
            <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data" class="p-6">
                @csrf
                {{-- Modal Headline --}}
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Create Project') }}
                </h2>
                <!-- Title -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Title')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="title"
                        :value="old('title')" autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Contact Name and Email Side by Side -->
                <div class="mt-4 flex items-center justify-between gap-2">
                    {{-- Contact Name --}}
                    <div>
                        <x-input-label for="contact_name" :value="__('Contact Name')" />
                        <x-text-input id="contact_name" class="block mt-1 w-full" type="text" name="contact_name"
                            :value="old('contact_name') ?? Auth::user()->name" />
                        <x-input-error :messages="$errors->get('contact_name')" class="mt-2" />
                    </div>
                    <div class="flex-1">
                        <x-input-label for="contact_email" :value="__('Contact Email')" />
                        <x-text-input id="contact_email" class="block mt-1 w-full" type="email" name="contact_email"
                            :value="old('contact_email') ?? Auth::user()->email" />
                        <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
                    </div>
                </div>

                {{-- Description --}}
                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        name="description" rows="5">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                {{-- Number of students --}}
                <div class="mt-4">
                    <x-input-label for="num_students_needed" :value="__('Number of Students')" />
                    <x-text-input id="num_students_needed" class="block mt-1 w-full" type="number"
                        name="num_students_needed" :value="old('num_students_needed')" />
                    <x-input-error :messages="$errors->get('num_students_needed')" class="mt-2" />
                </div>

                {{-- Trimester and Year inline --}}
                <div class="mt-4 flex items-center justify-between gap-2">
                    <div class="flex-1">
                        <x-input-label for="trimester" :value="__('Trimester')" />
                        <select id="trimester"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            name="trimester">
                            {{-- old value selected --}}
                            <option value="1" {{ old('trimester') == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('trimester') == 2 ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('trimester') == 3 ? 'selected' : '' }}>3</option>
                        </select>
                        <x-input-error :messages="$errors->get('trimester')" class="mt-2" />
                    </div>
                    <div class="flex-1">
                        <x-input-label for="year" :value="__('Year')" />
                        <x-text-input id="year" class="block mt-1 w-full" type="number" name="year"
                            :value="old('year')" />
                        <x-input-error :messages="$errors->get('year')" class="mt-2" />
                    </div>
                </div>

                {{--  Files --}}
                <div class="mt-4 flex">
                    <div>
                        <x-input-label for="images" :value="__('Upload Images')" />
                        <input type="file" name="images[]" id="images" accept="image/*" multiple class="my-2">
                    </div>
                    <div>
                        <x-input-label for="pdfs" :value="__('Upload PDF Files')" />
                        <input type="file" name="pdfs[]" id="pdfs" accept=".pdf" multiple class="my-2">
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end mt-6">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <x-primary-button class="ml-4">
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </form>
        @endif
    </x-modal>
</div>
