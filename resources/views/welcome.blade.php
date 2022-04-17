<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>تهنئة | أرسل السعادة لمن تحب</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

    <style>
        body {
            min-height: 100vh;
        }

        * {
            font-family: 'Tajawal', sans-serif;
        }

        .header img {
            object-fit: cover;
            object-position: top;
        }

        .header h1 {
            color: #2196f3;
            font-size: 70px;
            font-weight: 900;
        }

        .header p {
            color: #2196f3;
        }

        .image-view a {
            background-color: #2196f3 !important;
            color: #fff !important;
            border: 0 !important;
        }

        .footer {
            margin-top: 130px;
        }

        @media only screen and (max-width: 767px) {
            .image-view {
                margin-top: 50px;
            }
        }
        
    </style>
</head>

<body class="antialiased" dir="rtl">

    <div class="container">

        <div class="card bg-dark text-white header">
            <img height="200" src="{{ asset('images/header.jpg') }}" class="card-img" alt="...">
            <div class="card-img-overlay title">
                <h1 class="card-title">تهنئة</h1>
                <p class="text-dark">أرسل السعادة لمن تحب</p>
            </div>
        </div>

        <div class="row mt-5 ">
            <div class="col-md-6 congrats-form position-relative">
                <form class="card" method="post" action="{{ route('write.on.image') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        اكتب التهنئة هنا
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label for="exampleInputLogo1" class="form-label">لوجو شركتك</label>
                            <input type="file" name="logo" class="form-control" id="exampleInputLogo1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">اسم الشخص</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                placeholder="اكتب اسم الشخص هنا">
                        </div>

                        <div class="mb-3">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                        aria-selected="true">رمضان</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="false">العيد</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active mt-3" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">

                                    <label for="">اختر الصورة</label>
                                    <div class="row mt-4">
                                        <div class="col-lg-6">
                                            <img width="200" height="200" class="d-block"
                                                src="{{ asset('images/ramadan1.jpg') }}" alt="">
                                            <input class="mt-2" type="radio" name="img" value="ramadan1">
                                        </div>
                                        <div class="col-lg-6">
                                            <img width="200" height="200" class="d-block"
                                                src="{{ asset('images/ramadan2.jpg') }}" alt="">
                                            <input class="mt-2" type="radio" name="img" value="ramadan2">
                                        </div>
                                        @error('img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="tab-pane fade mt-3" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <label for="">اختر الصورة</label>
                                    <div class="row mt-4">
                                        <div class="col-lg-6">
                                            <img width="200" height="200" class="d-block"
                                                src="{{ asset('images/eid1.jpg') }}" alt="">
                                            <input class="mt-2" type="radio" name="img" value="eid1">
                                        </div>
                                        <div class="col-lg-6">
                                            <img width="200" height="200" class="d-block"
                                                src="{{ asset('images/eid2.jpg') }}" alt="">
                                            <input class="mt-2" type="radio" name="img" value="eid2">
                                        </div>
                                        <div class="col-lg-6">
                                            <img width="200" height="200" class="d-block"
                                                src="{{ asset('images/eid3.jpg') }}" alt="">
                                            <input class="mt-2" type="radio" name="img" value="eid3">
                                        </div>
                                        @error('img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary"
                            style="background: #2196f3;border:0;">أرسل</button>

                    </div>

                </form>

            </div>

            <div class="col-md-6 image-view">
                @php
                    $session_token = Session::get('_token');
                @endphp
               
                @if (file_exists(public_path('upload/') . "congrats_$session_token.jpg")) 
                    <img class="img-fluid" src="{{ asset('upload/congrats_' . $session_token . '.jpg') }}" alt="">
                @else
                    <img class="img-fluid d-block m-auto" src="{{ asset('images/no_image.jpg') }}" alt="">
                @endif

                <a class="btn btn-danger mt-3 text-start download ms-3 start-0"
                href="{{ route('download.image') }}">تحميل الصورة</a>
            </div>
        </div>

    </div>

    <div class="card text-center footer w-100">
        <div class="card-footer text-muted">
            جميع الحقوق محفوظة &copy; 2022 <a href="{{url('/')}}">تهنئة</a>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
        
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
            }
        @endif
    </script>
</body>

</html>
