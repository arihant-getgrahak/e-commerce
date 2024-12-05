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
                    <!-- getExchangeRate($session('country')) -->
                    <p class="medium text-light m-0 p-0">
                        {{ __("Get Free delivery from :currency:amount Shop Now", ['currency' => $navigations['data']['currency'], 'amount' => $navigations['data']['delivery']]) }}
                    </p>
                </div>
            </div>

            <!-- Right Menu -->
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12">
                <div class="currency-selector dropdown js-dropdown float-right">
                    <a href="javascript:void(0);" data-toggle="dropdown" class="popup-title" title="Currency"
                        aria-label="Currency dropdown">
                        <span class="hidden-xl-down medium text-light">Country:</span>
                        <span class="iso_code medium text-light"> <img
                                src="{{ asset('vendor/blade-flags/country-' . Str::lcfirst($navigations["telcode"]) . '.svg') }}"
                                width="20" height="20" /> {{Str::upper($navigations["telcode"])}}
                        </span>
                        <i class="fa fa-angle-down medium text-light"></i>
                    </a>
                    <ul class="popup-content dropdown-menu">
                        <li><a title="Euro" onclick="country(this.id)" href="javascript:void(0);" id="in"
                                class="dropdown-item medium text-medium"><img
                                    src="{{ asset('vendor/blade-flags/country-in.svg') }}" width="32"
                                    height="32" />India</a>
                        </li>
                        <li><a title="Euro" onclick="country(this.id)" href="javascript:void(0);" id="de"
                                class="dropdown-item medium text-medium"><img
                                    src="{{ asset('vendor/blade-flags/country-de.svg') }}" width="32"
                                    height="32" />Germany</a>
                        </li>
                        <li class="current"><a title="US Dollar" href="javascript:void(0);" id="gb"
                                onclick="country(this.id)" class="dropdown-item medium text-medium">
                                <img src="{{ asset('vendor/blade-flags/country-uk.svg') }}" width="32" height="32" />
                                UK</a></li>
                        <li class="current"><a title="US Dollar" href="javascript:void(0);" id="us"
                                onclick="country(this.id)" class="dropdown-item medium text-medium">
                                <img src="{{ asset('vendor/blade-flags/country-us.svg') }}" width="32" height="32" />
                                USA
                            </a></li>
                        <li class="current"><a title="US Dollar" href="javascript:void(0);" id="cn"
                                onclick="country(this.id)" class="dropdown-item medium text-medium">
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
                        <span class="iso_code medium text-light">{{Str::upper(App::getLocale())}}</span>
                        <i class="fa fa-angle-down medium text-light"></i>
                    </a>
                    <ul class="dropdown-menu popup-content link">
                        <li class="current"><a href="javascript:void(0);" class="dropdown-item medium text-medium"
                                onclick="changeLanguage(this.id)" id="hi"><img
                                    src="{{ asset('vendor/blade-flags/country-in.svg') }}" alt="en" width="16"
                                    height="11" /><span>Hindi</span></a>
                        </li>
                        <li class="current"><a href="javascript:void(0);" class="dropdown-item medium text-medium"
                                onclick="changeLanguage(this.id)" id="en"><img
                                    src="{{ asset('vendor/blade-flags/country-in.svg') }}" alt="en" width="16"
                                    height="11" /><span>English</span></a>
                        </li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"
                                onclick="changeLanguage(this.id)" id="de"><img
                                    src="{{ asset('vendor/blade-flags/country-de.svg') }}" alt="de" width="16"
                                    height="11" /><span>German</span></a>
                        </li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"
                                onchangeLanguage(this.id)" id="zh"><img
                                    src="{{ asset('vendor/blade-flags/country-cn.svg') }}" alt="china" width="16"
                                    height="11" /><span>Chinese</span></a>
                        </li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"
                                onclick="changeLanguage(this.id)" id="en-gb"><img
                                    src="{{ asset('vendor/blade-flags/country-uk.svg') }}" alt="uk" width="16"
                                    height="11" /><span>English UK</span></a>
                        </li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"
                                onclick="changeLanguage(this.id)" id="en-us"><img
                                    src="{{ asset('vendor/blade-flags/country-us.svg') }}" alt="us" width="16"
                                    height="11" /><span>English US</span></a>
                        </li>
                    </ul>
                </div>

                <div class="currency-selector dropdown js-dropdown float-right mr-3">
                    <a href="{{route('wishlist')}}" class="text-light medium">{{__("Wishlist")}}</a>
                </div>

                <div class="currency-selector dropdown js-dropdown float-right mr-3">
                    <a href="{{route('my-orders')}}" class="text-light medium">{{__("My Account")}}</a>
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
                    @foreach (collect($navigations["navigation"]) as $navigation)
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
    function country(id) {
        $.ajax({
            url: "{{ route('update.global.country') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "name": id
            },
            success: function (data) {
                location.reload();
            }
        });
    }
</script>
<script>
    function changeLanguage(lang) {
        // console.log(lang);
        $.ajax({
            url: "{{ route('lang.change') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "lang": lang
            },
            success: function (data) {
                location.reload();
            }
        });
    }
</script>