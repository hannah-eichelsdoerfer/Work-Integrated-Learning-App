<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Applications
        </h2>
    </x-slot>

    @foreach ($applications as $application)
        <div class="border rounded-lg p-4 mb-4">
            <p class="text-xs text-gray-500">{{ $application->created_at }}</p>
            <p class="text-xl font-semibold">{{ $application->project->title }}</p>
            <p class="">Offered by <span class="font-bold">{{ $application->project->industryPartner->user->name }}</span> in <span class="font-bold text-red-500">Trimester
                {{ $application->project->trimester }}
                {{ $application->project->year }}</span></p>
            <p class="mt-2 uppercase text-xs">Contact</p>
            <p class="">{{ $application->project->contact_name }} | {{ $application->project->contact_email }}</p>
        </div>
    @endforeach
</x-app-layout>
