@extends('frontend.layouts.default')
@section('content')
<div class="row our-mission">
    <div class="left-main col-lg-3 pr-3 mt-3">
        <div class="title">
            <h2>About Us</h2>
        </div>
        <ul class="about-us-child">
            <li class="item">
            <a class="link active" href="{{ route('our_mission') }}">Our Mission</a>
            </li>
            <li class="item">
                <a class="link" href="{{ route('our_story') }}">Our Story</a>
            </li>
            <li class="item">
                <a class="link" href="#">Our Client</a>
            </li>
            <li class="item">
                <a class="link" href="#">Job Opportunities</a>
            </li>
            <li class="item">
                <a class="link" href="#">Contact</a>
            </li>
        </ul>

    </div>
    <div class="right-main col-lg-9 mt-3">
        <div class="content pl-5 pr-5">
            <h3 class="pb-3">Our Client</h3>
            <img src="" alt="">
            <p>Saltware cooperated with Gyeonggi-do in 2013 to develop technology to export plant plant technology to countries in the Middle East such as Kuwait and Qatar.
            </p>
            <p>In addition, since 2018, Saltware has been collaborating to develop smart farm technology that can grow Qatar, tomatoes, and strawberries.
            </p>
            <p>Salt A & B plans to develop and export desert seedling cultivators in 2019 in cooperation with local companies in Qatar based on the technology and experience of the parent company. Later, the company plans to build a greenhouse where the seedlings can be grown directly in a desert environment and to test the technology of cultivation and distribute it to local farmers in Qatar.
            </p>
        </div>
    </div>
</div>
@endsection
