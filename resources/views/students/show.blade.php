<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Student Profile
            </h2>
            @if (auth()->user()->id == $student->user->id)
                <a href="{{ route('profile.edit') }}">
                    <x-primary-button>
                        Edit Profile
                    </x-primary-button>
                </a>
            @endif
        </div>
    </x-slot>

    <div>
        <h1 class="text-2xl font-semibold">{{ $student->user->name }}</h1>
        <p class="text-gray-600">{{ $student->user->email }}</p>
        <p class="text-lg mt-2">GPA: {{ $student->gpa }}</p>

        <div class="mt-4">
            <h2 class="text-lg font-semibold">Roles:</h2>
            <ul class="list-disc ml-6">
                @foreach ($student->roles as $studentRole)
                    <li>{{ $studentRole->role->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
