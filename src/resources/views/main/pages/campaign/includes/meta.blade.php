<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{$data->meta_title}}</title>
    <meta name="description" content="{{$data->meta_description}}"/>

    <meta property="og:locale" content="{{$data->og_locale}}" />
	<meta property="og:type" content="{{$data->og_type}}" />
	<meta property="og:title" content="{{$data->og_title}}" />
	<meta property="og:description" content="{{$data->og_description}}" />
	<meta property="og:url" content="{{Request::url()}}" />
	<meta property="og:site_name" content="{{$data->og_site_name}}" />
	<meta property="og:image" content="{{empty($data->og_image) ? asset('campaign/images/favicon.png') : $data->og_image_link}}" />
	<meta name="twitter:card" content="{{$data->header_logo_link}}" />
	<meta name="twitter:label1" content="{{$data->og_title}}" />
	<meta name="twitter:data1" content="{{$data->og_description}}" />

    <link rel="icon" href="{{ empty($data->og_image) ? asset('campaign/images/favicon.png') : $data->og_image_link }}" sizes="32x32" />
    <link rel="icon" href="{{ empty($data->og_image) ? asset('campaign/images/favicon.png') : $data->og_image_link }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ empty($data->og_image) ? asset('campaign/images/favicon.png') : $data->og_image_link }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('campaign/css/bootstrap.min.css')}}">
    {{-- <link rel="stylesheet" href="https://kit.fontawesome.com/b6a944420c.css"> --}}
    <link rel="stylesheet" href="{{ asset('campaign/css/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('campaign/css/tabs.css')}}">
    <link rel="stylesheet" href="{{ asset('campaign/css/iziToast.min.css')}}">
    <link rel="stylesheet" href="{{ asset('campaign/css/img-previewer.css')}}">
    <link rel="stylesheet" href="{{ asset('campaign/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('campaign/css/owl.theme.default.min.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('campaign/css/styles.css')}}">

    {!!$data->meta_header!!}
</head>
