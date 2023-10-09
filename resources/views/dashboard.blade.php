<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- log variables that are sent --}}

    <x-slot name="slot">
        @if (auth()->user()->type === 'Teacher')
            <x-teacher-dashboard />
        @elseif (auth()->user()->type === 'Industry Partner')
            <x-industry-partner-dashboard />
        @elseif (auth()->user()->type === 'Student')
            <x-student-dashboard />
        @endif
    </x-slot>
</x-app-layout>
