<footer role="contentinfo">
    <div class="main-footer">
        <div class="container">
            <div class="row new-footer-row">
                <div class="col-sm-12 footer-col-auto">
                    <h5>BOOK A SITE VISIT FOR SPECIAL OFFER</h5>
                </div>
                <div class="col-sm-12 footer-col-auto d-sm-none">
                    <img class="lazyload" data-src="{{$data->footer_logo_link}}" alt="Logo">
                </div>
                <div class="col-sm-12 footer-col-auto">
                    <ul>
                        @if($data->email)
                        <li>
                            <a href="mailto:{{$data->email}}" aria-label="Email"><i class="fas fa-envelope"></i>
                                {{$data->email}}</a>
                        </li>
                        @endif
                        @if($data->phone)
                        <li>
                            <a href="tel:{{$data->phone}}" aria-label="Phone"><i class="fas fa-mobile-android-alt"></i> {{$data->phone}}</a>
                        </li>
                        @endif
                        @if($data->address)
                        <li>
                            <a href="#" aria-label="Address"><i class="fas fa-map-marker-alt"></i> {{$data->address}}</a>
                        </li>
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="copy-holder">
        <div class="container">
            <div class="row justify-content-center justify-sm-center align-items-center">
                <p>Copyrights {{date('Y')}} SNN Raj Corp | All Rights Reserved</p><br/>
                @if($data->CampaignAbout)
                <div class="col-12 text-center mt-1">
                    <p>
                        <b>RERA NO:</b> {{ $data->CampaignAbout->rera }}
                    </p>
                </div>
                @endif
                <div class="col-12 d-flex justify-content-center align-items-center footer-icon-col mt-2">
                    @if($data->facebook)
                    <a class="footer-icon" href="{{$data->facebook}}" target="_blank" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    @endif
                    @if($data->instagram)
                    <a class="footer-icon" href="{{$data->instagram}}" target="_blank" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if($data->youtube)
                    <a class="footer-icon" href="{{$data->youtube}}" aria-label="Youtube"
                    target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                    @endif
                    @if($data->linkedin)
                    <a class="footer-icon" href="{{$data->linkedin}}" target="_blank" aria-label="Linkedin">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
