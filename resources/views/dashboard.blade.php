<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Your Unique Form Link : <a target="_blank"
                            href="{{ $userData['uniqueUrl'] }}">{{ $userData['uniqueUrl'] }}</a></p>
                </div>
            </div>
            <h2 class="mt-6 font-weight-bolder text-uppercase" style="font-size: 2.2rem;">My Contacts</h2>

            @if (empty($AllCustomers))
                <h1>No Customers !</h1>
            @else
                @foreach ($AllCustomers as $customers)
                <div class="bg-white dark:bg-gray-800 text-center overflow-hidden shadow-sm sm:rounded-lg mt-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                       <div class="flex items-center justify-center mt-4 gap-4">
                        <div class="col">
                            <span class="contact_entityname">Customer Name</span>
                            <h2 class="contact_entity_value">{{$customers['name']}}</h2>
                        </div>
                        <div class="col">
                            <span class="contact_entityname">Customer's Phonenumber</span>
                            <h2 class="contact_entity_value">{{$customers['phoneNumber']}}</h2>
                        </div>
                        <div class="col">
                            <span class="contact_entityname">Customer's Email</span>
                            <h2 class="contact_entity_value">{{$customers['email']}}</h2>
                        </div>

                        <div class="col">
                            <span class="contact_entityname">Customer's Budget</span>
                            <h2 class="contact_entity_value">{{$customers['desireBudget']}}</h2>
                        </div>

                        <div class="col">
                            <span class="contact_entityname">Customer's Message</span>
                            <h2 class="contact_entity_value">{{$customers['message']}}</h2>
                        </div>
                       </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
