@if ($message = Session::get('success'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-success alert-block shadow-lg">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>
    </div>
@endif


@if ($message = Session::get('error'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-danger alert-block shadow-lg">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>
    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-warning alert-block shadow-lg">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-info alert-block shadow-lg">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>
    </div>
@endif

