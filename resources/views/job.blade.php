<x-layout>
    <x-slot:heading>
        Job Description
    </x-slot:heading>
    <h2 class="font-bold text-lg">{{ $job['title'] }}</h2>
    <p>
        This job pays {{ $job['salary'] }} per {{ $job['pay_frequency'] }}.
    </p>
</x-layout>
