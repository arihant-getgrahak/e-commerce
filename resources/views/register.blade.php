@extends("layout.frontend")

@section("section")

<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Register</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="middle">
    <div class="container">
        <form class="border p-3 rounded" action="{{ route('register') }}" method="post">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">{{__("Name")}} *</label>
                    <input type="text" class="form-control" placeholder="{{__("Name")}}" required id="name" name="name"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="email">{{__("Email")}}*</label>
                    <input type="email" class="form-control" placeholder="joe@joe.com" required name="email" id="email"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="country_code">{{__("Country Code")}} *</label>
                    <input type="text" class="form-control" placeholder="+91" required name="country_code"
                        id="country_code" value="{{ $telcode }}">
                    @error('country_code')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="phone_number">{{__("Phone Number")}} *</label>
                    <input type="tel" class="form-control" placeholder="9672670732" required name="phone_number"
                        id="phone_number" value="{{ old('phone_number') }}">
                    @error('phone_number')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="password">{{__("Password")}} *</label>
                    <input type="password" class="form-control" placeholder="{{__("Password")}}*" required id="password"
                        name="password">
                    @error('password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="confirm_password">{{__("Confirm Password")}} *</label>
                    <input type="password" class="form-control" placeholder="{{__("Confirm Password")}}*" required
                        id="confirm_password" name="confirm_password">
                    @error('confirm_password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <p>{{__("Register Agreement")}}</p>
            </div>

            <div class="form-group">
                <button type="submit"
                    class="btn btn-md full-width bg-dark text-light fs-md ft-medium">{{__("Sign Up")}}</button>
            </div>
            <div>
                <a href="{{ route('google.redirect') }}" class="btn btn-primary"> {{__("Login with Google")}} </a>
                <a href="{{ route('facebook.redirect') }}" class="btn btn-primary"> {{__("Login with Facebook")}} </a>
            </div>
        </form>
        <div>
            {{__("Already have an account?")}} <a href="{{route('login')}}" class="text-dark">{{__("Login")}}</a>
        </div>
    </div>
</section>
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
        arihant.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ${{{ session('error') }}}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
                                            `
        window.scrollTo(0, 0);
    }
</script>
@endsection