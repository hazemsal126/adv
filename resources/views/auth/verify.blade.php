@extends('front.layout.master')

@section('title','الصفحة الرئيسية')

@section('content')

    <section class='sign wow bounceIn'>
        <div class="container">
            <div class="sign__wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="sign__title">تأكيد البريد الالكتروني!</h2>
                        <p class='sign__text'>قبل البدء، من فضلك قم بتأكيد بريدك الالكتروني من خلال الكود المرسل.</p>
                    </div>
                    <div class="col-md-6 mt-4 text-right d-flex align-items-center justify-content-center justify-md-content-end">
                        <form action="{{route('front.verifymail')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-7">
                                    <input type="number" name="token" class='form-control'>
                                </div>
                                <div class="col-lg-4">
                                    <button type="submit"  class='btn btn-primary'>تأكيد</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-7">
                                    <a href="{{route('front.resentcode')}}"> اعادة ارسال</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
