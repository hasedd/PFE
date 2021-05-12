<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>askNprovide &#8211;Platforme</title>
        <meta name='robots' content='max-image-preview:large' />
        <link rel='dns-prefetch' href='//www.google.com' />
        <link rel='dns-prefetch' href='//fonts.googleapis.com' />
        <link rel='dns-prefetch' href='//s.w.org' />
        <link rel="alternate" type="application/rss+xml" title="Template &raquo; Feed" href="http://template.test/feed/" />
        <link rel="alternate" type="application/rss+xml" title="Template &raquo; Comments Feed" href="http://template.test/comments/feed/" />
        <style type="text/css">
            img.wp-smiley,
            img.emoji {
                display: inline !important;
                border: none !important;
                box-shadow: none !important;
                height: 1em !important;
                width: 1em !important;
                margin: 0 .07em !important;
                vertical-align: -0.1em !important;
                background: none !important;
                padding: 0 !important;
            }
        </style>
        <link rel='stylesheet' id='discy-entypo-css'  href="{{asset('Dassets/wp-content/themes/discy/css/entypo/entypoe23c.css?ver=5.7')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='dashicons-css'  href="{{asset('Dassets/wp-includes/css/dashicons.min.css?ver=5.7')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='admin-bar-css'  href="{{asset('Dassets/wp-includes/css/admin-bar.min.css?ver=5.7')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='wp-block-library-css'  href="{{asset('Dassets/wp-includes/css/dist/block-library/style.min.css?ver=5.7')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='wpqa-custom-css-css'  href="{{asset('Dassets/wp-content/plugins/WPQA/assets/css/custom.css?ver=4.4.4')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='contact-form-7-css'  href="{{asset('Dassets/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=5.4')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='prettyPhoto-css'  href="{{asset('Dassets/wp-content/themes/discy/css/prettyPhoto.css?ver=5.7')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='discy-font-awesome-css'  href="{{asset('Dassets/wp-content/themes/discy/css/fontawesome/css/fontawesome-all.min.css?ver=5.7')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='discy-main-style-css'  href="{{asset('Dassets/wp-content/themes/discy/style.css')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='discy-fonts-css'  href='//fonts.googleapis.com/css?family=%27Open+Sans%3A100%2C100i%2C200%2C200i%2C300%2C300i%2C400%2C400i%2C500%2C500i%2C600%2C600i%2C700%2C700i%2C800%2C800i%2C900%2C900i%7CRoboto%3A100%2C100i%2C200%2C200i%2C300%2C300i%2C400%2C400i%2C500%2C500i%2C600%2C600i%2C700%2C700i%2C800%2C800i%2C900%2C900i%26amp%3Bsubset%3Dcyrillic%2Ccyrillic-ext%2Cgreek%2Cgreek-ext%2Clatin-ext%2Cvietnamese%26amp%3Bdisplay%3Dswap&#038;ver=4.4.4' type='text/css' media='all' />
        <link rel='stylesheet' id='discy-basic-css-css'  href="{{asset('Dassets/wp-content/themes/discy/css/basic.css?ver=4.4.4')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='discy-main-css-css'  href="{{asset('Dassets/wp-content/themes/discy/css/main.css?ver=4.4.4')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='discy-vars-css-css'  href="{{asset('Dassets/wp-content/themes/discy/css/vars.css?ver=4.4.4')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='discy-responsive-css'  href="{{asset('Dassets/wp-content/themes/discy/css/responsive.css?ver=4.4.4')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='discy-skin-default-css'  href="{{asset('Dassets/wp-content/themes/discy/css/skins/skins.css?ver=4.4.4')}}" type='text/css' media='all' />
        <link rel='stylesheet' id='discy-custom-css-css'  href="{{asset('Dassets/wp-content/themes/discy/css/custom.css?ver=4.4.4')}}" type='text/css' media='all' />
        <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/jquery/jquery.min.js?ver=3.5.1')}}" id='jquery-core-js'></script>
        <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.3.2')}}" id='jquery-migrate-js'></script>
        <link rel="https://api.w.org/" href="{{asset("Dassets/wp-json/")}}" /><link rel="alternate" type="application/json" href="{{asset("Dassets/wp-json/wp/v2/pages/64")}}" /><link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://template.test/xmlrpc.php?rsd" />
        <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="{{asset("Dassets/wp-includes/wlwmanifest.xml")}}" />
        <link rel="alternate" type="application/json+oembed" href="{{asset("Dassets/wp-json/oembed/1.0/embed?url=http%3A%2F%2Ftemplate.test%2F")}}" />
        <link rel="alternate" type="text/xml+oembed" href="{{asset("Dassets/wp-json/oembed/1.0/embed?url=http%3A%2F%2Ftemplate.test%2F&#038;format=xml")}}" />
        <link rel="shortcut icon" href="{{asset("Dassets/wp-content/uploads/2018/04/logo.png")}}" type="image/x-icon">
        <meta name="theme-color" content="#2d6ff7">
        <meta name="msapplication-navbutton-color" content="#2d6ff7">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"><meta property="og:site_name" content="Template">
        <meta property="og:url" content="http://template.test/">
        <meta property="og:image" content="{{asset("Dassets/wp-content/uploads/2019/05/screenshot.png")}}">
        <meta name="twitter:image" content="{{asset("Dassets/wp-content/uploads/2019/05/screenshot.png")}}">
        <style type="text/css" media="print">#wpadminbar { display:none; }</style>
        <style type="text/css" media="screen">
            html { margin-top: 32px !important; }
            * html body { margin-top: 32px !important; }
            @media screen and ( max-width: 782px ) {
                html { margin-top: 46px !important; }
                * html body { margin-top: 46px !important; }
            }
        </style>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @livewireScripts

    </body>
</html>
