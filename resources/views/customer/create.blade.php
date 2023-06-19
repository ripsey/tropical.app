<x-app-layout>
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h1 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">
                Nieuwe klant
            </h1>
            <form action="{{ route('customer.store') }}" method="POST">
                @csrf
                <x-input-label class="mb-2 mt-2" for="firstname" :value="__('Voornaam')" />
                <x-text-input id="firstname" name="firstname" type="text" value="{{ old('firstname') }}" class="block w-full" autofocus />
                @error('firstname')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="lastname" :value="__('Familienaam')" />
                <x-text-input id="lastname" name="lastname" type="text" value="{{ old('lastname') }}" class="block w-full" />
                @error('lastname')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="text" value="{{ old('email') }}" class="block w-full" />
                @error('email')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="mobile" :value="__('Mobiel')" />
                <x-text-input id="mobile" name="mobile" type="text" value="{{ old('mobile') }}" class="block w-full" />
                @error('phone')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="phone" :value="__('Telefoon')" />
                <x-text-input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="block w-full" />
                @error('phone')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="address" :value="__('Adres')" />
                <x-text-input id="address" name="address" type="text" value="{{ old('address') }}" class="block w-full" />
                @error('address')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="postalcode" :value="__('Postcode')" />
                <x-text-input id="postalcode" name="postalcode" type="text" value="{{ old('postalcode') }}" class="block w-full" />
                @error('postalcode')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input-label class="mb-2 mt-2" for="city" :value="__('Stad')" />
                <x-text-input id="city" name="city" type="text" value="{{ old('city') }}" class="block w-full" />
                @error('city')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-primary-button class="mt-4">Toevoegen</x-primary-button>
            </form>
        </div>
    </div>
    <script>
        const postalcode_input = document.querySelector('#postalcode');
        const city_input = document.querySelector('#city');
        inputPostalcodeChanged = () => {
            if (postalcode_input.value != '') fetch(postalcode_input.value + '/city').then(response => response.json())
                .then(data => {
                    if (data != '') city_input.value = data
                })
        };
        inputCityChanged = () => {
            if (city_input.value != '') fetch(city_input.value + '/zipcode').then(response => response.json())
                .then(data => {
                    if (data != '') postalcode_input.value = data
                })
        };
        postalcode_input.addEventListener('change', inputPostalcodeChanged);
        city_input.addEventListener('change', inputCityChanged);
    </script>
</x-app-layout>