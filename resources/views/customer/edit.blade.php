<x-app-layout>
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h1 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">
                Klant wijzigen
            </h1>
            <form action="{{ route('customer.update',$customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <x-input-label class="mb-2 mt-2" for="firstname" :value="__('Voornaam')" />
                <x-text-input id="firstname" name="firstname" type="text" value="{{ $customer->firstname }}" class="block w-full" autofocus />
                @error('firstname')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="lastname" :value="__('Familienaam')" />
                <x-text-input id="lastname" name="lastname" type="text" value="{{ $customer->lastname }}" class="block w-full" />
                @error('lastname')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" value="{{ $customer->email }}" class="block w-full" />
                @error('email')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="mobile" :value="__('Mobiel')" />
                <x-text-input id="mobile" name="mobile" type="text" value="{{ $customer->mobile }}" class="block w-full" />
                @error('phone')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="phone" :value="__('Telefoon')" />
                <x-text-input id="phone" name="phone" type="text" value="{{ $customer->phone }}" class="block w-full" />
                @error('phone')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="address" :value="__('Adres')" />
                <x-text-input id="address" name="address" type="text" value="{{ $customer->address }}" class="block w-full" />
                @error('address')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="postalcode" :value="__('Postcode')" />
                <x-text-input id="postalcode" name="postalcode" type="text" value="{{ $customer->postalcode }}" class="block w-full" />
                @error('postalcode')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="city" :value="__('Stad')" />
                <x-text-input id="city" name="city" type="text" value="{{ $customer->city }}" class="block w-full" />
                @error('city')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-primary-button class="mt-4">Info wijzigen</x-primary-button>
            </form>
        </div>
    </div>
    <script>
        const postalcode_input = document.querySelector('#postalcode');
        const city_input = document.querySelector('#city');
        inputPostalcodeChanged = () => {
            if (postalcode_input.value != '') fetch('../' + postalcode_input.value + '/city').then(response => response.json())
                .then(data => {
                    if (data != '') city_input.value = data
                })
        };
        inputCityChanged = () => {
            if (city_input.value != '') fetch('../' + city_input.value + '/zipcode').then(response => response.json())
                .then(data => {
                    if (data != '') postalcode_input.value = data
                })
        };
        postalcode_input.addEventListener('change', inputPostalcodeChanged);
        city_input.addEventListener('change', inputCityChanged);
    </script>
</x-app-layout>