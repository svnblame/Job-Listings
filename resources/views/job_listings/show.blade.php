<x-layout>
    <x-slot:heading>
        Job Description
    </x-slot:heading>
    <h2 class="font-bold text-lg">{{ $job->title }}</h2>
    <p>
        This job pays {{ $job->salaryUS() }} per {{ $job->pay_frequency }}.
    </p>

    <p class="mt-6">
        <x-button href="/jobs/{{ $job->id }}/edit">Edit Job Listing</x-button>
    </p>
</x-layout>
