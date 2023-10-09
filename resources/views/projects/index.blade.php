{{-- There is a projects-list page that displays all projects (names) group by the year and trimester of offering. For each group of projects, the grouping should be obvious and the year and trimester for that group should be clearly displayed. The groups are displayed in reverse
chronological order, i.e. the latest year/trimester should be displayed at the top, follow by the 2nd latest group. Clicking on a project will bring up the details page for that project. --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Projects
        </h2>
    </x-slot>

    <div class="space-y-4">
        @foreach ($projects as $year => $trimesters)
            <div class="border rounded-lg p-4">
                <h2 class="text-2xl font-semibold text-gray-800 leading-tight">{{ $year }}</h2>
                @foreach ($trimesters as $trimester => $projectGroup)
                    <div class="mt-4">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-semibold">Trimester {{ $trimester }}</h2>
                            @if (auth()->user()->type == 'Teacher')
                                {{-- <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                    onclick="autoAssign({{ $projectGroup }})">Auto Assign</button> --}}
                                {{-- <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                    onclick="autoAssign({{ $year }}, {{ $trimester }})">Auto Assign</button> --}}
                                <form method="post" action="{{ route('teachers.assign') }}">
                                    @csrf
                                    <input type="hidden" name="year" value="{{ $year }}">
                                    <input type="hidden" name="trimester" value="{{ $trimester }}">
                                    <x-danger-button>Auto Assign</x-danger-button>
                                </form>
                            @endif
                        </div>
                        <ul class="list-disc pl-4">
                            @foreach ($projectGroup as $project)
                                <li>
                                    <a class="text-red-500 hover:underline"
                                        href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @endforeach

        {{-- <script>
            function autoAssign(year, trimester) {
                // Send an AJAX request to the server to trigger the auto-assignment
                fetch('/teacher/assign', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        year: year,
                        trimester: trimester
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response here, e.g., display a success message
                    console.log(data);
                    // You can add logic to update the UI if needed
                })
                .catch(error => {
                    // Handle errors, display an error message, etc.
                    console.error('Error:', error);
                });
            }
        </script> --}}
    </div>
</x-app-layout>
