@extends('layouts')
@section('body')
    <section>
        <div style="position: fixed;z-index: -1" class="w-100">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel"
                 style="z-index: -3">
                <div class="carousel-inner">
                    @foreach($photos as $url)
                        <div class="carousel-item @if($loop->first) active @endif" data-bs-interval="2000000">
                            <img src="{{$url}}" class="d-block w-100" alt="...">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="top-0 absolute w-100 h-100" style="background: rgba(0,0,0,0.4);z-index: -2"></div>
        </div>
        <div style="height: 50vh;">
        </div>
    </section>
    <section style="background: white">
        <div class="container pb-5">
            <div class="p-4 d-flex flex-column align-items-center">
                <div style="font-size: 30px;" class="font-bold">Кто мы?!</div>
                <hr class="w-25 m-4">
                <div class="text-center">
                    <div class="card-title" style="font-size: 25px">Мы дружный коллектив "Октава"!</div>
                    <div class="card-text">
                        Здесь все о нашей театральной жизни: <br>наших наставниках, новых постановках, участиях в
                        фестивалях
                        <br> и многом-многом другом.
                    </div>
                </div>
            </div>
            <div class="p-4 d-flex flex-column align-items-center">
                <div class="pb-2 mt-5 w-100" style="background-color: rgba(128,128,128,0.08);border-radius: 4px">
                    <div class="splide mb-3" id="primary-slider">
                        <div class="splide__track">
                            <div class="splide__list">
                                @foreach($spectacles as $spectacle)
                                    <div class="splide__slide element" data-id="{{$spectacle->id}}">
                                        <div style="position: relative">
                                            <div class="card bg-dark text-white">
                                                <img src="{{$spectacle->url}}" class="card-img" style="z-index: 0">
                                                <div class="card-img-overlay" style="z-index: 2;">
                                                    <h5 class="card-title w-25"
                                                        style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;">{{$spectacle->title}}</h5>
                                                    <p class="card-text w-25"
                                                       style="max-height: 242px;overflow: hidden;">{{$spectacle->description}}</p>
                                                    <p class="card-text">{{$spectacle->created_at->format('H:i d/m/Y')}}</p>
                                                </div>
                                            </div>
                                            <div class="hover-card w-100 h-100 top-0"
                                                 style="background-color: rgba(0, 0, 0, 0.25);position: absolute;border-radius: 0.25em;z-index: 1;"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="splide" id="secondary-slider">
                        <div class="splide__track">
                            <div class="splide__list">
                                @foreach($spectacles as $spectacle)
                                    <div class="splide__slide">
                                        <div style="border-radius: 4px;overflow: hidden">
                                            <img src="{{$spectacle->url}}" alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="w-25 m-4">
                <div class="text-center">
                    <div class="card-title" style="font-size: 25px">Вся жизнь — театр, а люди в нем — актеры</div>
                    <div class="card-text">
                        Мы обучим вас не просто выступать как профессиональный актер, а жить сценой, <br> словно это ваш
                        второй дом!
                    </div>
                    <div class="btn btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#addUser">Узнать
                        подробнее
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{asset('request')}}" class="modal-content" id="formRequest">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Заявка для обратной связи</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select class="form-select" name="type">
                        <option value="Актер">Актер</option>
                        <option value="Танцор">Танцор</option>
                        <option value="Певец">Певец</option>
                    </select>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Как к вам обращаться?</label>
                        <input type="text" class="form-control" name="fio" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Телефон</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Подать заявку</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <style>
        #secondary-slider .splide__track .splide__slide {
            opacity: 0.75;
        }

        #secondary-slider .splide__track .is-active {
            opacity: 1;
            border: none;
        }
    </style>
    <script>
        $('#formRequest').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{asset('request')}}',
                data: {
                    '_token': "{{csrf_token()}}",
                    'fio': $('input[name=fio]').val(),
                    'phone': $('input[name=phone]').val(),
                    'type': $('select[name=type]').val()
                },
                dataType: 'JSON',
                success: (response) => {
                    window.location.reload()
                }
            })
        });
        let secondary = new Splide('#secondary-slider', {
            rewind: true,
            fixedWidth: 100,
            fixedHeight: 64,
            isNavigation: true,
            gap: 10,
            focus: 'center',
            pagination: false,
            cover: true,
            breakpoints: {
                '600': {
                    fixedWidth: 66,
                    fixedHeight: 40,
                }
            }
        }).mount();
        new Splide('#primary-slider', {
            type: 'fade',
            heightRatio: 0.5,
            pagination: false,
            arrows: false,
            cover: true,
        }).sync(secondary).mount();
    </script>
@endsection