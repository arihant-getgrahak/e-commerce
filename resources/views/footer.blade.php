<footer class="dark-footer skin-dark-footer style-2">
    <div class="footer-middle">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <div class="footer_widget">

                        <img src="{{asset('assets/img/logo-light.png')}}" class="img-footer small mb-2" alt="" />

                        <div class="address mt-3">
                            Jaipur<br>India 302039
                        </div>
                        <div class="address mt-3">
                            +919672670732<br>arihant.jain@getgrahak.in
                        </div>
                        <div class="address mt-3">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#"><i class="lni lni-facebook-filled"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="https://x.com/arihantjain916"><i
                                            class="lni lni-twitter-filled"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="lni lni-youtube"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="https://www.instagram.com/arihantjain91/"><i
                                            class="lni lni-instagram-filled"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="https://www.linkedin.com/in/arihantjain916/"><i
                                            class="lni lni-linkedin-original"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                @foreach (collect($navigations["navigation"]) as $navigation)
                    @if ($navigation->name === 'Footer')
                        @foreach ($navigation->menus as $menu)
                            @if(count($menu->children) > 0)
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                    <div class="footer_widget">
                                        <h4 class="widget_title">{{ $menu->name }}</h4>
                                        <ul class="footer-menu">
                                            @foreach ($menu->children as $children)
                                                <li><a href="{{ $children->link }}">{{ $children->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                    <div class="footer_widget">
                                        <h4 class="widget_title">
                                            <a href="{{$menu->link}}">
                                                <h4 class="widget_title">
                                                    {{ $menu->name }}
                                                </h4>
                                            </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach



                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <div class="footer_widget">
                        <h4 class="widget_title">Subscribe</h4>
                        <p>Receive updates, hot deals, discounts sent straignt in your inbox daily</p>
                        <div class="foot-news-last">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Email Address">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text b-0 text-light"><i
                                            class="lni lni-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="address mt-3">
                            <h5 class="fs-sm text-light">Secure Payments</h5>
                            <div class="scr_payment"><img src="assets/img/card.png" class="img-fluid" alt="" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 text-center">
                    <p class="mb-0">© 2024 Arihant Jain.</p>
                </div>
            </div>
        </div>
    </div>
</footer>