@php
    use App\Models\Role;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Project Details
        </h2>
    </x-slot>

    <x-slot name="slot">
        <!-- Project Details -->
        <div class="mb-6">
            <p class="text-gray-500 text-xs">{{ $project->created_at }}</p>
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold">{{ $project->title }}</h3>
                <!-- Edit and Delete Buttons (if Industry Partner) -->
                @if (auth()->user()->id == $project->industryPartner->user->id)
                    <div class="flex justify-end">
                        <x-secondary-button class="mr-2">
                            <a href="{{ route('projects.edit', $project) }}">Edit</a>
                        </x-secondary-button>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button>Delete</x-danger-button>
                        </form>
                    </div>
                @endif
            </div>
            <p class="text-gray-600">Offered by: {{ $project->industryPartner->user->name }} in Trimester
                {{ $project->trimester }} {{ $project->year }}</p>
            <p class="text-gray-600">Contact: {{ $project->contact_name }} | {{ $project->contact_email }}</p>
            <p class="mt-4">{{ $project->description }}</p>
        </div>

        <!-- Display Files -->
        <div class="mb-6 gap-5 flex flex-wrap">
            @foreach ($project->projectFiles as $file)
                @if ($file->file_type === 'pdf')
                    <a href="{{ asset('storage/' . $file->file_path) }}" download
                        class="text-red-500 hover:underline flex items-center space-x-1 mb-2">
                        <x-heroicon-o-document-arrow-down class="w-5 h-5 inline-block" />
                        <span>{{ $file->file_name }}</span>
                    </a>
                @endif
            @endforeach
        </div>

        <!-- Display Images -->
        <div class="mb-6 space-x-2 flex flex-wrap">
            @foreach ($project->projectFiles as $file)
                @if ($file->file_type === 'image')
                    <img src="{{ asset('storage/' . $file->file_path) }}" alt="{{ $file->file_name }}"
                        class="w-32 h-32 object-cover mb-2">
                @endif
            @endforeach
        </div>

        <hr class="mb-6">

        <!-- Assigned Students -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4">Assigned Students</h2>
            @if ($project->students->count() > 0)
                <ul class="list-disc pl-4">
                    @foreach ($project->students as $student)
                        <li>
                            <a class="text-red-500 hover:underline"
                                href="{{ route('students.show', $student->id) }}">
                                {{ $student->user->name }} 
                                | {{ $student->gpa }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 italic">No students assigned yet</p>
            @endif
        </div>

        
        <!-- Applications -->
        <hr class="mb-6">
        <div>
            @if (auth()->user()->type == 'Student')
                @if (auth()->user()->student->applications->contains('project_id', $project->id))
                    <p>You have applied for this project.</p>
                    <p><a href="{{ route('applications.index') }}"
                            class="text-red-500 hover:underline">View applications</a></p>
                @elseif (auth()->user()->student->hasCompletedProfile())
                    <form action="{{ route('projects.apply', $project) }}" method="POST" class="space-y-2">
                        @csrf
                        <x-input-label for="justification" :value="__('Apply for Project')" />
                        <x-text-input id="justification" name="justification" type="text" class="mt-1 block w-3/4"
                            placeholder="Justification" :value="old('justification')" />
                        <x-input-error :messages="$errors->get('justification')" class="mt-2" />
                        <x-primary-button class="mr-2">Apply</x-primary-button>
                    </form>
                @else
                    <p class="mb-4">Please complete your profile before applying</p>
                    <form action="{{ route('students.update', auth()->user()->student) }}" method="POST" class="space-y-2">
                        @csrf
                        @method('PATCH')
                        <x-input-label for="gpa" :value="__('GPA')" />
                        <x-text-input id="gpa" name="gpa" type="text" class="mt-1 block w-3/4"
                            placeholder="GPA" :value="old('gpa')" />
                        <x-input-error :messages="$errors->get('gpa')" class="mt-2" />
                        <x-input-label for="roles" :value="__('Roles')" />
                        <select name="roles[]" id="roles" multiple
                            class="w-3/4 mt-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @foreach (Role::all() as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                            <div>

                                <x-primary-button class="mr-2">Update</x-primary-button>
                            </div>
                    </form>
                @endif
            @elseif (auth()->user()->type == 'Industry Partner' || auth()->user()->type == 'Teacher')
                <h2 class="text-2xl font-semibold mb-4">Applications</h2>
                @forelse ($project->applications as $application)
                    <div class="border-b border-gray-300 pb-4 mb-4">
                        <p class="text-xs text-gray-500">{{ $application->created_at }}</p>
                        <p class="text-xl font-semibold">{{ $application->student->user->name }}</p>
                        <p class="text-gray-600">{{ $application->student->user->email }}</p>
                        <p class="mt-2 italic font-mono">{{ $application->justification }}</p>

                        {{-- Teacher sees link to profile --}}
                        @if (auth()->user()->type == 'Teacher' || auth()->user()->id == $application->student->user->id)
                            <a href="{{ route('students.show', $application->student) }}"
                                class="text-red-500 hover:underline">View Profile</a>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 italic">No applications yet</p>
                @endforelse
            @endif
        </div>
    </x-slot>
</x-app-layout>
