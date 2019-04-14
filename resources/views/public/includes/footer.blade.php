<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h4 class="h6">About Us</h4>
                <p>
                    Pellentesque habitant morbi tristique senectus et netus et
                    malesuada fames ac turpis egestas.
                </p>
                <hr>

                <h4 class="h6">Join Our Monthly Newsletter</h4>
                <form action="{{ route('subscriber.store') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Subscribe.." />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary"><i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
                <hr class="d-block d-lg-none">
            </div>

            <div class="col-lg-3">
                <h4 class="h6">Blog</h4>
                {{--@if (count(mainPosts()) > 0)--}}
                    <ul class="list-unstyled footer-blog-list">
                        {{--@foreach (mainPosts() as $key => $value)--}}
                            <li class="d-flex align-items-center">
                                <div class="image">
                                    <img src="{{ asset('images/blog/small/'{{--.$value->image--}}) }}" alt="{{-- $value->title --}}" class="img-fluid">
                                </div>
                                <div class="text">
                                    <h5 class="mb-0">
                                        {{--<a href="{{ route('blog.post', $value->slug) }}">{{ $value->title }}</a>--}}
                                    </h5>
                                </div>
                            </li>
                        {{--@endforeach--}}
                    </ul>
                {{--@endif--}}
                <hr class="d-block d-lg-none">
            </div>
            <div class="col-lg-3">
                <h4 class="h6">Contact</h4>
                <p class="text-uppercase">
                    <strong>{{config('app.name')}} (Pty) Ltd.</strong><br>
                    13/25 New Avenue <br>
                    Suburb <br>
                    45Y 73J <br>
                    Mpumalanga <br>
                    <strong>South Africa</strong>
                </p>
                <a href="{{route('contact')}}" class="btn btn-template-main">Go to contact page</a>
                <hr class="d-block d-lg-none">
            </div>

            <div class="col-lg-3">
                <h4 class="h4">Social</h4>
                <ul class="social d-flex flex-row align-item-left">
                    <li>
                        <a href="#" style="background-color: #3a61c9">
                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" style="background-color: #41a1f6">
                            <i class="fab fa-twitter" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" style="background-color: #fb4343">
                            <i class="fab fa-google-plus" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" style="background-color: #8f6247">
                            <i class="fab fa-instagram" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="copyrights">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 text-center-md">
                    <p>&copy; {{date('Y')}}. {{ config('app.name') }}</p>
                </div>
                <div class="col-lg-8 text-right text-center-md">
                    <p>Developed by <a href="#">OCTS </a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
