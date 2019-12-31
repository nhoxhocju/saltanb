@extends('frontend.layouts.default')
@section('content')
<div class="row our-mission">
    <div class="left-main col-lg-3 pr-3 mt-3">
        <div class="title">
            <h2>About Us</h2>
        </div>
        {{-- <a class="content-cat">Our Mission</a>
        <a class="content-cat">Our Story</a>
        <a class="content-cat">Our Client</a>
        <a class="content-cat">Job Opportunities</a>
        <a class="content-cat">Contact</a> --}}
        <ul class="about-us-child">
            <li class="item">
            <a class="link active" href="{{ route('our_mission') }}">Our Mission</a>
            </li>
            <li class="item">
                <a class="link" href="#">Our Story</a>
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
            <h3>Our Mission</h3>
            <p>Due to changes in the global climate environment, abnormal weather events are occurring around the world. Scientists are predicting that in the next 50 years, the planet may turn into a climate where plants cannot be grown. Future food problems are expected to threaten the most basic human life requirements.
            </p>
            <p>Salta&b wants to develop various technologies to overcome climate change and grow plants stably, and contribute to solving the food problem coming through these technologies.
            </p>
            <p>To this end, we will put our capacity to achieve our biggest goal of solving food problems through the development and practical application of technology to grow plants in extreme climate environments such as deserts.
            </p>
            <p class="text-right">CEO SUNGHEE LEE</p>
        </div>
    </div>
</div>
@endsection
