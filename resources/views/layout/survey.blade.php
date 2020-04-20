<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="height:100%">

<head>
    <title>Survei Preferensi Pelayanan Publik - PT MRT Jakarta</title>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta charset="utf-8">
    <meta name="author" content="Radityo Putra Paripurna | alterfingers.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="description"
        content="Survei Preferensi Kebijakan Parkir, Layanan Feeder, Jalur Sepeda, dan Jalur Pejalan Kaki terhadap Layanan MRT di DKI Jakarta">
    <meta name="keywords" content="Survei Preferensi Kebijakan Parkir,Survei Preferensi Layanan Feeder,Survei Preferensi Jalur Sepeda,Survei Preferensi Jalur Pejalan Kaki,Survei PT MRT Jakarta">
    <meta property="og:image" content="{{ asset('img/logo-mrtj.png') }}">

    <meta property="og:title" content="Survei Preferensi - PT MRT Jakarta" />
    <meta property="og:url" content="https://surveylayanan.jakartamrt.co.id" />
    <meta property="og:description"
        content="Survei Preferensi Kebijakan Parkir, Layanan Feeder, Jalur Sepeda, dan Jalur Pejalan Kaki terhadap Layanan MRT di DKI Jakarta">
    <link type="image/png" href="https://www.jakartamrt.co.id/wp-content/uploads/2019/03/favicon.png" rel="icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700|Roboto:400,700&display=swap" rel="stylesheet">    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Facebook Pixel Code -->
    {{-- <script>
    ! function (f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function () {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '2336573976610206');
    fbq('track', 'PageView');

  </script>
  <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=2336573976610206&ev=PageView&noscript=1" /></noscript> --}}
    <!-- End Facebook Pixel Code -->
</head>

<body style="height:100%">
    <!--[if IE]>
 <p>Applkasi ini tidak mendukung Internet Explorer

 </p>
<![endif]-->
    @yield('content')


</body>

</html>
