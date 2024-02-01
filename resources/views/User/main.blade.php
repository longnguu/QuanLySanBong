<!DOCTYPE html>
<html lang="zxx">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
@include('User.Elements.head')
<body>
@include('User.Elements.header')

<div id="loading-overlay" class="lds-roller"><div></div><div></div><div></div></div>
@yield('content')
</body>
@include('User.Elements.footer')

