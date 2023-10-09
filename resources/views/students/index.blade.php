<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Students
        </h2>
    </x-slot>

    {{-- Students --}}
    @foreach ($students as $student)
        <div>
            <h1 class="font-semibold">{{ $student->user->name }}</h1>
            <p class="text-gray-600">{{ $student->user->email }}</p>
            <p>GPA: {{ $student->gpa }}</p>
            <ul class="list-disc ml-6">
                @foreach ($student->roles as $studentRole)
                    <li>{{ $studentRole->role->name }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
    {{ $students->links() }}
</x-app-layout>
