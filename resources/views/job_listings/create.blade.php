<x-layout>
    <x-slot:heading>
        Create Job Listing
    </x-slot:heading>

    <form method="POST" action="/jobs">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Create a new job listing</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Just enter the details below.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="title">Title</x-form-label>
                        <x-form-input name="title" id="title" placeholder="Job Title" />
                        <x-form-error name="title" />
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="salary">Salary</x-form-label>
                        <x-form-input name="salary" id="salary" placeholder="Salary" />
                        <x-form-error name="salary" />
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="pay_frequency">Salary</x-form-label>
                        <x-form-input name="pay_frequency" id="pay_frequency" placeholder="Pay Frequency i.e. year, month, week" />
                        <x-form-error name="pay_frequency" />
                    </x-form-field>
                </div>
            </div>

        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
{{--            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>--}}
            <a href="/jobs"
               type="button"
               class="text-sm font-semibold leading-6 text-gray-900">
                Cancel
            </a>
            <x-form-submit-button>Save</x-form-submit-button>
        </div>
    </form>

</x-layout>
