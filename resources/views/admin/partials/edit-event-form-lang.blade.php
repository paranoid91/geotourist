@if($lang == "ge")
<?php
    $trans = [
            "h1" => "ივენთის აღწერა ქართულად", "h1_for_days" => "აღწერა დღეების მიხედვით(3/7/10 დღე)",
            "day" => "დღე", "days" => "დღე", "days-title" => "დღიანი ტური",
            "title" => "დასახელება: ", "location" => "მდებარეობა: ", "dept_time" => "გასვლის დრო: ",
            'return_time' => "დაბრუნების დრო: ", "body" => "ტურის აღწერა: ",
            "short_description" => "მოკლე აღწერა (არ უნდა აღემატებოდეს 170 სიმბოლოს)"
    ];
?>
@elseif($lang == "en")
<?php
    $trans = [
            "h1" => "Event Description In English", "h1_for_days" => "Description By Days(3/7/10 Days)",
            "day" => "Days", "days" => "Days", "days-title" => "Days Tour",
            "title" => "Title: ", "location" => "Location: ", "dept_time" => "Depture Time: ",
            'return_time' => "Return Time: ", "body" => "Tour Description: ",
            "short_description" => "Short Description (არ უნდა აღემატებოდეს 170 სიმბოლოს)"
    ];
?>
@elseif($lang == "ru")
<?php
    $trans = [
            "h1" => "Oписание Мероприятия По Pусски", "h1_for_days" => "Oписание По Дням (3/7/10 Дней)",
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
    {!! Form::text($lang . '_title', $event->title, ["class" => "form-control"]) !!}
</div>
<div class=""><span style="font-weight: bold">{{$trans['short_description']}}</span>
    <br><br>
    {!! Form::textarea($lang . '_short_body', $event->short_body , ["class" => "short-desc-text summernote"]) !!}
</div>
<div class=""><span style="font-weight: bold">{{$trans['body']}}</span>
    <div class="row">
        {!! Form::textarea($lang . '_body', $event->body , ["class" => "summernote"]) !!}
    </div>
</div>
