@extends("layout.frontend")

@section("section")

<section class="middle">
    <div class="container">
        <form class="border p-3 rounded">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control" placeholder="Name" required id="name" name="name">
                    @error('name')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email*</label>
                    <input type="email" class="form-control" placeholder="joe@joe.com" required name="email" id="email">
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="country_code">Country Code *</label>
                    <input type="text" class="form-control" placeholder="IN" required name="country_code"
                        id="country_code">
                    @error('country_code')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="phone_number">Phone Number *</label>
                    <input type="tel" class="form-control" placeholder="+919672670732" required name="phone_number"
                        id="phone_number">
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
                </div>
            </div>

            <div class="form-group">
                <p>By registering your details, you agree with our Terms & Conditions, and Privacy and Cookie
                    Policy.</p>
            </div>

            <div class="form-group">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="flex-1">
                        <input id="ddd" class="checkbox-custom" name="ddd" type="checkbox">
                        <label for="ddd" class="checkbox-custom-label">Sign me up for the Newsletter!</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Create An
                    Account</button>
            </div>
        </form>
    </div>
</section>
@endsection