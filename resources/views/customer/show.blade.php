<x-app-layout>
    @if ($message = Session::get('success'))
    <div class="bg-gray-400 text-white p-4 mb-4 shadow sm:rounded-lg">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="grid md:gap-4 grid-cols-1 md:grid-cols-3">
            <div class="p-4 bg-white dark:bg-gray-800 shadow md:rounded-lg col-span-1">
                <h1 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ $customer->firstname }} {{ $customer->lastname }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400" title="E-mailadres">{{ $customer->email }}</p>
                <p class="text-gray-600 dark:text-gray-400" title="Mobiel">{{ $customer->mobile }}</p>
                <p class="text-gray-600 dark:text-gray-400" title="Telefoon">{{ $customer->phone }}</p>
                <p class="text-gray-600 dark:text-gray-400" title="Adres">{{ $customer->address }}</p>
                <p class="text-gray-600 dark:text-gray-400 mb-4" title="Postcode en stad">{{ $customer->postalcode }} {{ strtoupper($customer->city) }}</p>
                <a href="{{ route('customer.edit',$customer->id) }}" title="Edit" class="inline-flex items-center px-4 py-2 mb-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Info wijzigen</a>
                <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Verwijderen') }}</x-danger-button>
            </div>
            <div class="p-4 bg-white dark:bg-gray-800 shadow md:rounded-lg col-span-2 customer-info">
                <form action="{{ route('customer.update',$customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Verkoop
                    </h2>
                    <textarea id="sale" name="sale" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block w-full">{{ $customer->sale }}</textarea>
                    <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100 my-4">
                        Stalen
                    </h2>
                    <textarea id="sample" name="sample" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block w-full">{{ $customer->sample }}</textarea>
                    <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100 my-4">
                        Notities
                    </h2>
                    <textarea id="note" name="note" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block w-full">{{ $customer->note }}</textarea>
                    <x-text-input id="firstname" name="firstname" type="text" value="{{ $customer->firstname }}" class="hidden" />
                    <x-text-input id="lastname" name="lastname" type="text" value="{{ $customer->lastname }}" class="hidden" />
                    <x-primary-button class="mt-4">Update</x-primary-button>
                </form>
            </div>
        </div>
    </div>
    <x-modal name="confirm-user-deletion" focusable>
        <form method="post" action="{{ route('customer.destroy',$customer->id) }}" class="p-6">
            @csrf
            @method('delete')
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure?') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Weet je zeker dat je {{ $customer->firstname }} {{ $customer->lastname }} wilt verwijderen?
            </p>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Annuleren') }}
                </x-secondary-button>
                <x-danger-button class="ml-3">
                    {{ __('Archiveren') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
    <script src="//cdn.ckeditor.com/4.21.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('note');
        CKEDITOR.replace('sale');
        CKEDITOR.replace('sample');
    </script>
</x-app-layout>