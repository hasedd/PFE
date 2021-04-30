<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <title>Template &#8211; Just another WordPress site</title>
        <meta name='robots' content='max-image-preview:large' />
        <link rel='dns-prefetch' href='//www.google.com' />
        <link rel='dns-prefetch' href='//fonts.googleapis.com' />
        <link rel='dns-prefetch' href='//s.w.org' />
        <link rel="alternate" type="application/rss+xml" title="Template &raquo; Feed" href="http://template.test/feed/" />
        <link rel="alternate" type="application/rss+xml" title="Template &raquo; Comments Feed" href="http://template.test/comments/feed/" />
        <script type="text/javascript">
            window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/svg\/","svgExt":".svg","source":{"concatemoji":"http:\/\/template.test\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.7"}};
            !function(e,a,t){var n,r,o,i=a.createElement("canvas"),p=i.getContext&&i.getContext("2d");function s(e,t){var a=String.fromCharCode;p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,e),0,0);e=i.toDataURL();return p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,t),0,0),e===i.toDataURL()}function c(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(o=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},r=0;r<o.length;r++)t.supports[o[r]]=function(e){if(!p||!p.fillText)return!1;switch(p.textBaseline="top",p.font="600 32px Arial",e){case"flag":return s([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])?!1:!s([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!s([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]);case"emoji":return!s([55357,56424,8205,55356,57212],[55357,56424,8203,55356,57212])}return!1}(o[r]),t.supports.everything=t.supports.everything&&t.supports[o[r]],"flag"!==o[r]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[o[r]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(n=t.source||{}).concatemoji?c(n.concatemoji):n.wpemoji&&n.twemoji&&(c(n.twemoji),c(n.wpemoji)))}(window,document,window._wpemojiSettings);
        </script>
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
        <meta name="generator" content="WordPress 5.7" />
        <link rel="canonical" href="http://template.test/" />
        <link rel='shortlink' href='http://template.test/' />
        <link rel="alternate" type="application/json+oembed" href="{{asset("Dassets/wp-json/oembed/1.0/embed?url=http%3A%2F%2Ftemplate.test%2F")}}" />
        <link rel="alternate" type="text/xml+oembed" href="{{asset("Dassets/wp-json/oembed/1.0/embed?url=http%3A%2F%2Ftemplate.test%2F&#038;format=xml")}}" />
        <link rel="shortcut icon" href="https://2code.info/demo/themes/Discy/Main/wp-content/themes/discy/images/favicon.png" type="image/x-icon">
        <meta name="theme-color" content="#2d6ff7">
        <meta name="msapplication-navbutton-color" content="#2d6ff7">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"><meta property="og:site_name" content="Template">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Template">
        <meta name="twitter:title" content="Template">
        <meta name="description" content="Just another WordPress site">
        <meta property="og:description" content="Just another WordPress site">
        <meta name="twitter:description" content="Just another WordPress site">
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
