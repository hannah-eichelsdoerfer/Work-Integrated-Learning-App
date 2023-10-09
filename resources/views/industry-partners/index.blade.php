<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Industry Partners') }}
        </h2>
    </x-slot>

    <div class="m-3">
        {{-- Display all Industry Partners --}}
        @foreach ($industryPartners as $industryPartner)
            <a href="{{ route('industry-partners.show', $industryPartner->id) }}">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h1 class="text-xl font-bold">{{ $industryPartner->user->name }}</h1>
                    </div>
                </div>
            </a>
        @endforeach
     </div>

    {{-- Pagination --}}
    {{ $industryPartners->links() }}
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-900">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    {{ $industryPartners->links() }}
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>
