@extends('layouts.auth')

@section('content')
    <form action="index.html" method="post">
        <h3>Forget Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
        </div>
        <div class="form-actions">
            <a href="{{ route('login') }}" id="back-btn" class="btn red btn-outline">Back </a>
            <button type="submit" class="btn green pull-right"> Submit </button>
        </div>
    </form>
@endsection