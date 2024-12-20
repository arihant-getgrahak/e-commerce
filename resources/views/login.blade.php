<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign in</title>

    <link rel="stylesheet" href={{asset('dist/css/tabler.min.css')}}>
    <link rel="stylesheet" href="{{asset('dist/css/tabler-flags.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/tabler-payments.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/demo.min.css')}}">

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class="d-flex flex-column">
    <script src="{{asset('dist/js/demo-theme.min.js')}}" defer></script>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">{{__("Login to your account")}}</h2>
                    <form action="{{ route('login.post') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{__("Email")}}</label>
                            <input type="email" class="form-control" placeholder="your@email.com" autocomplete="off"
                                name="email" id="email" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                {{__("Password")}}
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="{{__("Your Password")}}" autocomplete="off">
                                <span class="input-group-text">
                                    <a href="javascript:void(0)" class="link-secondary" title="Show password"
                                        data-bs-toggle="tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                </span>
                                @error('password')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">{{__("Sign In")}}</button>
                        </div>
                        <div class="mt-3 d-flex gap-2">
                            <a href="{{ route('google.redirect') }}" class="btn btn-primary">
                                {{__("Login with Google")}} </a>
                            <a href="{{ route('facebook.redirect') }}" class="btn btn-primary">
                                {{__("Login with Facebook")}} </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('dist/js/tabler.min.js')}}" defer></script>
    <script src="{{asset('dist/js/demo.min.js')}}" defer></script>
    <script>
        const arihant = document.querySelector('#alert');
        if ("{{session('success')}}") {
            arihant.innerHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
        ${{{ session('success') }}}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
                                            `
            window.scrollTo(0, 0);
        }
        if ("{{session('error')}}") {
            alert("{{session('error')}}")
        }
    </script>
</body>

</html>