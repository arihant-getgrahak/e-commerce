<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login::Auth</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-3xl font-bold">Laravel Auth::Login</h1>
        <form action="{{ route('login') }}" method="post" class="space-y-4 border border-black w-1/3 p-4 mt-4">
            @csrf


            <div class="flex flex-col gap-2">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="border border-black p-1 rounded-md"
                    placeholder="Your email" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="border border-black p-1 rounded-md"
                    placeholder="Your password">
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="w-full border border-black p-1 rounded-md bg-blue-500 text-white">Submit</button>
        </form>
    </div>

    <script>
        if ("{{ session('success') }}") {
            alert("{{ session('success') }}");
        }
        if ("{{ session('error') }}") {
            alert("{{ session('error') }}");
        }
    </script>
</body>

</html>