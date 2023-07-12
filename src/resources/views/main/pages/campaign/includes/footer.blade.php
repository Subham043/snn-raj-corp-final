<footer>
    <div class="main-footer">
        <div class="container">
            <img src="{{$data->footer_logo_link}}" alt="Logo">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 footer-col">
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
                <div class="col-lg-3 col-md-6 col-sm-12 footer-col">
                    <h5>Company</h5>
                    <ul>
                        <li>
                            <a href="https://www.snnrajcorp.com/about-us" target="_blank" aria-label="About us">About Us</a>
                        </li>
                        <li>
                            <a href="https://www.snnrajcorp.com/awards" target="_blank" aria-label="Awards">Awards</a>
                        </li>
                        <li>
                            <a href="https://www.snnrajcorp.com/about-us#jd" target="_blank" aria-label="Joint Development">Joint Development</a>
                        </li>
                        <li>
                            <a href="https://www.snnrajcorp.com/csr" target="_blank" aria-label="CSR">CSR</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-col">
                    <h5>Projects</h5>
                    <ul>
                        <li>
                            <a href="https://www.snnrajcorp.com/about-us" target="_blank" aria-label="About Us">About Us</a>
                        </li>
                        <li>
                            <a href="https://www.snnrajcorp.com/csr" target="_blank" aria-label="CSR">CSR</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-col">
                    <h5>Legal</h5>
                    <ul>
                        <li>
                            <a href="https://www.snnrajcorp.com/projects#ongoing" target="_blank" aria-label="Ongoing Projects">Ongoing</a>
                        </li>
                        <li>
                            <a href="https://www.snnrajcorp.com/projects#completed" target="_blank" aria-label="Completed Projects">Completed</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-holder">
        <div class="container">
            <div class="row justify-content-between justify-sm-center align-items-center">
                <p>Copyrights {{date('Y')}} SNN Raj Corp | All Rights Reserved</p>
                <div class="col-auto d-flex justify-content-between align-items-center footer-icon-col">
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
