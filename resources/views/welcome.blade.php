@extends('layouts.app')
@section ('content')
    <div class="front-page-top">
        <div class="front-page-img">
            <img src="{{ asset('images/frontpage-img.jpg') }}">
        </div>
        <div class="front-page-bg">
            <img src="{{ asset('images/frontpage-bg.png') }}">
        </div>

        <div class="sitename">
            <h1>همکاری بین بخشی و مشارکت مردم در سلامت استان</h1>
            <h2>سامانه همت</h2>
        </div>
    </div>

</div>
    <div class="front-page-link-box container row">

        <div class="col-md-4 py-4 text-center">
            <div class="blue-luzy icon-container">
                <a href="/">
                    <img src="{{ asset('images/icons/handshake.svg') }}">
                </a>
            </div>
            <div class="icon-container-text py-4">
                <a href="/">همکاری بین بخشی</a>
            </div>
        </div>

        <div class="col-md-4 py-4 text-center">
            <div class="orange-luzy icon-container">
                <a href="/">
                    <img src="{{ asset('images/icons/three-users.svg') }}">
                </a>
            </div>
            <div class="icon-container-text py-4">
                <a href="/">مشارکت مردم</a>
            </div>
        </div>

        <div class="col-md-4 py-4 text-center">
            <div class="blueg-luzy icon-container">
                <a href="/">
                    <img src="{{ asset('images/icons/refresh-button.svg') }}">
                </a>
            </div>
            <div class="icon-container-text py-4">
                <a href="/">هماهنگی درون بخشی</a>
            </div>
        </div>

        <div class="col-md-4 py-4 text-center">
            <div class="green-luzy icon-container">
                <a href="/">
                    <img src="{{ asset('images/icons/add-heart.svg') }}">
                </a>
            </div>
            <div class="icon-container-text py-4">
                <a href="/">دیده بانی سلامت استان</a>
            </div>
        </div>

        <div class="col-md-4 py-4 text-center">
            <div class="oranger-luzy icon-container">
                <a href="/">
                    <img src="{{ asset('images/icons/calendar.svg') }}">
                </a>
            </div>
            <div class="icon-container-text py-4">
                <a href="/">رویدادها</a>
            </div>
        </div>

        <div class="col-md-4 py-4 text-center">
            <div class="purple-luzy icon-container">
                <a href="/">
                    <img src="{{ asset('images/icons/asnadrahbordi.svg') }}">
                </a>
            </div>
            <div class="icon-container-text py-4">
                <a href="/">مرکز اسناد راهبردی</a>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
<script defer src="{{ mix('js/pages/welcome/index.js') }}"></script>
@endsection
