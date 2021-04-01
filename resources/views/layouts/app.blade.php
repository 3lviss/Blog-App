@include('inc.header')

<body>
    @include('inc.navbar')

    <main class="py-4">
        @yield('content')
    </main>

    @include('inc.footer')

</body>
</html>
