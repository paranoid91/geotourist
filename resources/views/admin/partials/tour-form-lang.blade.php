@if($lang == "ge")
    <?php
        $trans = [
            "h1" => "ტურის აღწერა ქართულად", "h1_for_days" => "აღწერა დღეების მიხედვით(3/7/10 დღე)",
            "day" => "დღე", "days" => "დღე", "days-title" => "დღიანი ტური",
            "title" => "დასახელება: ", "location" => "მდებარეობა: ", "dept_time" => "გასვლის დრო: ",
            'return_time' => "დაბრუნების დრო: ", "body" => "ტურის აღწერა: ", 
            "short_description" => "მოკლე აღწერა (არ უნდა აღემატებოდეს 170 სიმბოლოს)"
        ];
    ?>
@elseif($lang == "en")
    <?php
    $trans = [
            "h1" => "Tour Description In English", "h1_for_days" => "Description By Days(3/7/10 Days)",
            "day" => "Days", "days" => "Days", "days-title" => "Days Tour",
            "title" => "Title: ", "location" => "Location: ", "dept_time" => "Depture Time: ",
            'return_time' => "Return Time: ", "body" => "Tour Description: ",
            "short_description" => "Short Description (არ უნდა აღემატებოდეს 170 სიმბოლოს)"
    ];
    ?>
@elseif($lang == "ru")
    <?php
    $trans = [
            "h1" => "Oписание Tура По Pусски", "h1_for_days" => "Oписание По Дням (3/7/10 Дней)",
            "day" => "Дня", "days" => "Дней", "days-title" => "Дневный Тур",
            "title" => "Название: ", "location" => "Mесто Hахождение: ", "dept_time" => "Bремя Oтправления: ",
            'return_time' => "Bремя Bозврата: ", "body" => "Описание Тура: ",
            "short_description" => "Kраткое Oписание (არ უნდა აღემატებოდეს 170 სიმბოლოს)"
    ];
    ?>
@endif

<h2 class="text-center">{{ $trans["h1"] }}</h2>
<div class="form-group">
    {!! Form::label($lang . '_title', $trans["title"]) !!}
    {!! Form::text($lang . '_title', null, ["class" => "form-control"]) !!}
</div>
<div class="form-group">
    {!! Form::label($lang . '_location', $trans['location']) !!}
    {!! Form::text($lang . '_location', null, ["class" => "form-control"]) !!}
</div>
<div class="form-group">
    {!! Form::label($lang . '_dept_time', $trans['dept_time']) !!}
    {!! Form::text($lang . '_dept_time', null, ["class" => "form-control"]) !!}
</div>
<div class="form-group">
    {!! Form::label($lang . '_return_time', $trans['return_time']) !!}
    {!! Form::text($lang . '_return_time', null, ["class" => "form-control"]) !!}
</div>
<div class="form-group"><span style="font-weight: bold">{{$trans['short_description']}}</span>
    <br><br>
    {!! Form::textarea($lang . '_short_description', null, ["class" => "short-desc-text summernote"]) !!}
</div>
<div class=""><span style="font-weight: bold">{{$trans['body']}}</span>
    <div class="row">
        {!! Form::textarea($lang . '_body', null, ["class" => "summernote"]) !!}
    </div>
</div>
<div class="form-group">
    <hr>
    <h2 class="text-center">{{ $trans["h1_for_days"] }}</h2>
    <ul class="nav nav-tabs add-tour-days-tabs">
        @if($type==0)
            <li class="active"><a data-toggle="tab" href="#{{$lang}}_section3days" class="tour-desc-days-a">3 {{ $trans["day"] }}</a></li>
            <li><a data-toggle="tab" href="#{{$lang}}_section7days" class="tour-desc-days-a">7 {{ $trans["days"] }}</a></li>
            <li><a data-toggle="tab" href="#{{$lang}}_section10days" class="tour-desc-days-a">10 {{ $trans["days"] }}</a></li>
        @endif
    </ul>
    <div class="tab-content">
        @if($type==0)
            <div id="{{$lang}}_section3days" class="tab-pane fade in active tab-pane-holder">
                <h3 class="text-center">3 {{ $trans["days-title"] }}</h3>
                @include("admin/partials/days-list", ["count_days" => 3, "lang" => $lang])
            </div>
            <div id="{{$lang}}_section7days" class="tab-pane fade">
                <h3 class="text-center">7 {{ $trans["days-title"] }}</h3>
                @include("admin/partials/days-list", ["count_days" => 7 , "lang" => $lang])
            </div>
            <div id="{{$lang}}_section10days" class="tab-pane fade">
                <h3 class="text-center">10 {{ $trans["days-title"] }}</h3>
                @include("admin/partials/days-list", ["count_days" => 10 , "lang" => $lang])
            </div>
        @elseif($type==1)
            <div id="{{$lang}}_section10days">
                <h3 class="text-center">10 {{ $trans["days-title"] }}</h3>
                @include("admin/partials/days-list", ["count_days" => 10 , "lang" => $lang])
            </div>
        @endif
    </div>
</div>