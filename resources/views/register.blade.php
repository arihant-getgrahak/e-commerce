@extends("layout.frontend")

@section("section")

<section class="middle">
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
    <div class="container">
        <form class="border p-3 rounded" action="{{ route('register') }}" method="post">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control" placeholder="Name" required id="name" name="name"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email*</label>
                    <input type="email" class="form-control" placeholder="joe@joe.com" required name="email" id="email"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="country_code">Country Code *</label>
                    <input type="text" class="form-control" placeholder="IN" required name="country_code"
                        id="country_code" value="{{ old('country_code') }}">
                    @error('country_code')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="phone_number">Phone Number *</label>
                    <input type="tel" class="form-control" placeholder="+919672670732" required name="phone_number"
                        id="phone_number" value="{{ old('phone_number') }}">
                    @error('phone_number')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="password">Password *</label>
                    <input type="password" class="form-control" placeholder="Password*" required id="password"
                        name="password">
                    @error('password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="confirm_password">Confirm Password *</label>
                    <input type="password" class="form-control" placeholder="Confirm Password*" required
                        id="confirm_password" name="confirm_password">
                    @error('confirm_password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <p>By registering your details, you agree with our Terms & Conditions, and Privacy and Cookie
                    Policy.</p>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Create An
                    Account</button>
            </div>
            <div>
                <a href="{{ route('google.redirect') }}" class="btn btn-primary"> Register with Google </a>
                <a href="{{ route('facebook.redirect') }}" class="btn btn-primary"> Register with Facebook </a>
            </div>
        </form>
        <div>
            Already have an account? <a href="{{route('login')}}" class="text-dark">Login</a>
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