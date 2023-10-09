<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <h3 class="text-lg font-semibold mb-3">Industry Partners</h3>
    @foreach ($industryPartners as $industryPartner)
        <a href="{{ route('industry-partners.show', $industryPartner->id) }}" class="group">
            <div class="border border-gray-300 rounded-lg p-4 shadow-sm hover:shadow-md transition duration-300 transform hover:scale-105 mb-3 flex items-center justify-between">
                <h1 class="text-xl font-bold group-hover:text-red-500">{{ $industryPartner->user->name }}</h1>
                <p class="text-gray-600 group-hover:text-gray-800">{{ $industryPartner->industry }}</p>
                @if (!$industryPartner->approved)
                    <form action="{{ route('teachers.approve', $industryPartner->id) }}" method="POST">
                        @csrf
                        <x-danger-button>Approve</x-danger-button>
                    </form>
                @endif
            </div>
        </a>
    @endforeach
    {{ $industryPartners->links() }}
</div>
