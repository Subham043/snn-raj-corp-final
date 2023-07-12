<!DOCTYPE html>
<html lang="en">

@include('main.pages.campaign.includes.meta', ['data' => $data])

<body>
    @include('main.pages.campaign.includes.header', ['data' => $data])
    @include('main.pages.campaign.includes.banner', ['data' => $data])
    @include('main.pages.campaign.includes.about', ['data' => $data])
    @include('main.pages.campaign.includes.table', ['data' => $data])
    @include('main.pages.campaign.includes.gallery', ['data' => $data])
    @include('main.pages.campaign.includes.specification', ['data' => $data])
    @include('main.pages.campaign.includes.plan', ['data' => $data])
    @include('main.pages.campaign.includes.location', ['data' => $data])
    @include('main.pages.campaign.includes.amenities', ['data' => $data])
    <section class="mb-0">
        <div class="contact-holder" id="contact-section">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-8 col-md-6 col-sm-12 contact-col">
                        <h2>GET COST SHEET & BROCHURE</h2>
                        <p>Click Below To Download Floorplans & Cost Sheet of {{$data->name}} & Register for special offers.</p>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary formbuttonstyler" aria-label="Download Brouchure">Download Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- @include('main.pages.campaign.includes.creations') --}}
    {{-- @include('main.pages.campaign.includes.footer', ['data' => $data]) --}}
    @include('main.pages.campaign.includes.new_footer', ['data' => $data])


    <!-- Modal -->
    @include('main.pages.campaign.includes.contact_modal')
</body>
<!-- Main JS -->
@include('main.pages.campaign.includes.script', ['data' => $data])
</html>
