<div class="py-2 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 hide-ipad">
                <div class="top_first">
                    <a href="callto:+919672670732" class="medium text-light">(+91)9672670732</a>.
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 hide-ipad">
                <div class="top_second text-center">
                    <p class="medium text-light m-0 p-0">Get Free delivery from ₹2000 <a href="#"
                            class="medium text-light text-underline">Shop Now</a></p>
                </div>
            </div>

            <!-- Right Menu -->
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12">

                <div class="currency-selector dropdown js-dropdown float-right">
                    <a href="javascript:void(0);" data-toggle="dropdown" class="popup-title" title="Currency"
                        aria-label="Currency dropdown">
                        <span class="hidden-xl-down medium text-light">Currency:</span>
                        <span class="iso_code medium text-light"> <img
                                src="{{ asset('vendor/blade-flags/country-in.svg') }}" width="32" height="32" /> India
                        </span>
                        <i class="fa fa-angle-down medium text-light"></i>
                    </a>
                    <ul class="popup-content dropdown-menu">
                        <li><a title="Euro" href="#" class="dropdown-item medium text-medium"><img
                                    src="{{ asset('vendor/blade-flags/country-eu.svg') }}" width="32"
                                    height="32" />Europe</a>
                        </li>
                        <li class="current"><a title="US Dollar" href="#" class="dropdown-item medium text-medium">
                                <img src="{{ asset('vendor/blade-flags/country-uk.svg') }}" width="32" height="32" />
                                UK</a></li>
                        <li class="current"><a title="US Dollar" href="#" class="dropdown-item medium text-medium">
                                <img src="{{ asset('vendor/blade-flags/country-us.svg') }}" width="32" height="32" />
                                USA
                            </a></li>
                        <li class="current"><a title="US Dollar" href="#" class="dropdown-item medium text-medium">
                                <img src="{{ asset('vendor/blade-flags/country-cn.svg') }}" width="32" height="32" />
                                China
                            </a></li>
                    </ul>
                </div>

                <!-- Choose Language -->

                <div class="language-selector-wrapper dropdown js-dropdown float-right mr-3">
                    <a class="popup-title" href="javascript:void(0)" data-toggle="dropdown" title="Language"
                        aria-label="Language dropdown">
                        <span class="hidden-xl-down medium text-light">Language:</span>
                        <span class="iso_code medium text-light">English</span>
                        <i class="fa fa-angle-down medium text-light"></i>
                    </a>
                    <ul class="dropdown-menu popup-content link">
                        <li class="current"><a href="javascript:void(0);" class="dropdown-item medium text-medium"><img
                                    src="assets/img/1.jpg" alt="en" width="16" height="11" /><span>English</span></a>
                        </li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"><img
                                    src="assets/img/2.jpg" alt="fr" width="16" height="11" /><span>Français</span></a>
                        </li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"><img
                                    src="assets/img/3.jpg" alt="de" width="16" height="11" /><span>Deutsch</span></a>
                        </li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"><img
                                    src="assets/img/4.jpg" alt="it" width="16" height="11" /><span>Italiano</span></a>
                        </li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"><img
                                    src="assets/img/5.jpg" alt="es" width="16" height="11" /><span>Español</span></a>
                        </li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"><img
                                    src="assets/img/6.jpg" alt="ar" width="16" height="11" /><span>اللغة
                                    العربية</span></a></li>
                    </ul>
                </div>

                <div class="currency-selector dropdown js-dropdown float-right mr-3">
                    <a href="{{route('wishlist')}}" class="text-light medium">Wishlist</a>
                </div>

                <div class="currency-selector dropdown js-dropdown float-right mr-3">
                    <a href="{{route('my-orders')}}" class="text-light medium">My Account</a>
                </div>

            </div>

        </div>
    </div>
</div>
<div class="header header-light dark-text">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="/">
                    <img src="{{asset('assets/img/logo.png')}}" class="logo" alt="" />
                </a>
                <div class="nav-toggle"></div>
                <div class="mobile_nav">
                    <ul>
                        <li>
                            <a href="#" onclick="openSearch()">
                                <i class="lni lni-search-alt"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#login">
                                <i class="lni lni-user"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="openWishlist()">
                                <i class="lni lni-heart"></i><span class="dn-counter">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="openCart()">
                                <i class="lni lni-shopping-basket"></i><span class="dn-counter">0</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">
                    @foreach (collect($navigations[0]) as $navigation)
                        @if ($navigation->name === 'Header')
                            @foreach ($navigation->menus as $menu)
                                <li>
                                    <a href="{{ count($menu->children) > 0 ? 'javascript:void(0);' : $menu->link }}">
                                        {{ $menu->name }}
                                    </a>
                                    @if (count($menu->children) > 0)
                                        <ul class="nav-dropdown nav-submenu">
                                            @foreach ($menu->children as $child)
                                                <li>
                                                    <a href="{{$child->link}}">{{ $child->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                </ul>


                <ul class="nav-menu nav-menu-social align-to-right">
                    <li>
                        <a href="#" onclick="openSearch()">
                            <i class="lni lni-search-alt"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#login">
                            <i class="lni lni-user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="openWishlist()">
                            <i class="lni lni-heart"></i><span class="dn-counter bg-danger" id="wishlist-count">0</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="openCart()">
                            <i class="lni lni-shopping-basket"></i><span class="dn-counter bg-success"
                                id="cart-count">0</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownButton = document.getElementById("dropdownMenuButton");
        const dropdownMenu = document.querySelector(".dropdown-menu");
        const hiddenInput = document.getElementById("language");
        const selectedOption = document.getElementById("selected-option");

        dropdownButton.addEventListener("click", function () {
            dropdownMenu.classList.toggle("show");
        });

        dropdownMenu.addEventListener("click", function (e) {
            if (e.target.closest(".dropdown-item")) {
                const selectedItem = e.target.closest(".dropdown-item");
                const value = selectedItem.dataset.value;
                const content = selectedItem.innerHTML;

                // Update the button's display and hidden input value
                selectedOption.innerHTML = content;
                hiddenInput.value = value;

                dropdownMenu.classList.remove("show");
            }
        });

        // Close dropdown on clicking outside
        document.addEventListener("click", function (e) {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove("show");
            }
        });
    });

</script>