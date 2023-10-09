<x-app-layout>
    {{-- Industry Partner name --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Indutry Partner Details</h2>
    </x-slot>

    <section class="mb-6">
        <h3 class="font-semibold text-lg text-gray-800">{{ $industryPartner->user->name }}</h3>
        <p>{{ $industryPartner->user->email }}</p>
    </section>

    <h3 class="font-semibold text-lg text-gray-800 mb-3">Projects</h3>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        {{-- Industry Partner projects --}}
        @forelse ($industryPartner->projects as $project)
            <a href="{{ route('projects.show', $project->id) }}"
                class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                @if ($project->projectFiles->where('file_type', 'image')->count() > 0)
                    <img src="{{ asset('storage/' . $project->previewImage()->file_path) }}"
                        alt="{{ $project->previewImage()->file_name }}"
                        class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg">
                @else
                    <div class="w-full h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg bg-gray-300">
                    </div>
                @endif
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $project->title }}</h5>
                    </h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        {{ $project->description }}
                    </p>
                </div>
            </a>
        @empty
            <p class="text-gray-500 italic">No projects found.</p>
        @endforelse
    </div>
</x-app-layout>
