<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>

    @foreach ($jobs as $job)
        <ul>
            <li>
                <a href="/jobs/{{ $job['id'] }}" class="text-blue-500 hover:underline">
                    <strong>{{ $job['title'] }}:</strong> Pays {{ $job['salary'] }} per {{ $job['pay-frequency'] }}
                </a>
            </li>
        </ul>
    @endforeach
</x-layout>
