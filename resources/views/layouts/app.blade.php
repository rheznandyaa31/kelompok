<!DOCTYPE html>
<html lang="en">

@include('layouts.partials.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('layouts.partials.navbar')
        @include('layouts.partials.sidebar')
        @include('layouts.partials.content')
        @include('layouts.partials.footer')

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

    @include('layouts.partials.foot')
</body>

</html>
