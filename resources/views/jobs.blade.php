<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>

    <div class="space-y-4">
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg hover:bg-sky-200 hover:text-blue-600">
                <div class="font-bold text-blue-500 text-sm">
                    {{ $job->employer->name }}
                </div>
                <div>
                    <strong>{{ $job['title'] }}:</strong> Pays {{ $job->salaryUS() }} per {{ $job['pay_frequency'] }}
                </div>
            </a>
        @endforeach
    </div>
</x-layout>
