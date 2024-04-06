@include('layouts.admin.header')

<body>
    @include('layouts.admin.darklight')


    <div class="container-fluid px-0">
        <!-- <div class="row"> -->
            <div id="wrapper" class="">
                @include('layouts.admin.sidebar')
                <div id="content-wrapper" class="bg-body-tertiary mt-0">
                    <div id="content" class="bg-body-tertiary">
                        @include('layouts.admin.navbar')

                        <!-- @include('layouts.admin.body') -->
                        @yield('content')
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </div>
    @include('layouts.admin.footer')