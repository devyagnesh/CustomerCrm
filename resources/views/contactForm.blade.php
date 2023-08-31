<!DOCTYPE html>
<html lang="en">

<head>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Contact Form</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&amp;display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/contact-form.css'])
</head>

<body>
    <main class="contactWrapper">
        <form method="POST" action="{{ route('postContact') }}" class="w-50">
            @error('err')
                <p>{{ $message }}</p>
            @enderror


            @csrf
            <input type="hidden" name="ci" value="{{ $ClientFormData['id'] }}" />
            <input type="hidden" name="curl" value="{{ $ClientFormData['urlToken'] }}" />
            <!-- Name -->
            <div class="form-group">
                <label for="name" :value="__('Name')">Name :</label>
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
                <input id="name" class="block mt-1 w-full" type="text" name="name" value="" required
                    autofocus autocomplete="name" />
                <p></p>
            </div>

            <div class="form-group mt-4">
                <label for="phonenumber">Phone Number :</label>
                @error('phonenumber')
                    <p>{{ $message }}</p>
                @enderror
                <input id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber" value=""
                    required autofocus autocomplete="phonenumber" />
                <p></p>
            </div>

            <div class="form-group mt-4">
                <label for="email">Email address :</label>
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
                <input id="email" class="block mt-1 w-full" type="email" name="email" value="" required
                    autofocus autocomplete="email" />
                <p></p>
            </div>

            <div class="form-group mt-4">
                <label for="budget">Desire Budget :</label>
                @error('budget')
                    <p>{{ $message }}</p>
                @enderror
                <input id="budget" class="block mt-1 w-full" type="number" name="budget" value="" required
                    autofocus autocomplete="number" />
                <p></p>
            </div>

            <div class="form-group mt-4">
                <label for="message">Message :</label>
                @error('message')
                 <p>{{ $message }}</p>
                @enderror
                <textarea id="message" class="block mt-1 w-full" name="message" required autofocus autocomplete="message"></textarea>
                <p></p>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="py-2 px-4 bg-dark rounded text-white mx-auto w-100">
                    {{ __('Submit') }}
                </button>
            </div>
        </form>
    </main>
</body>

</html>
