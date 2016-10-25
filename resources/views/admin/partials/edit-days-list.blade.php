@if($lang == "ge")
    <?php
    $trans = [
            "dai" => "დღე", "headline" => "სათაური: ", "sub" => "ქვეპუნკტები", "add-sub" => "+ ქვეპუნკტის დამატება",
            "includes" => "ტურის მოცულობა", "inc" => "ტური შეიცავს", "not-inc" => "ტური არ შეიცავს",
            "body" => "ტურის აღწერა: "
    ];
    ?>
@elseif($lang == "en")
    <?php
    $trans = [
            "dai" => "Day", "headline" => "Headline: ", "sub" => "Submenu", "add-sub" => "+ Add Submenu",
            "includes" => "Tour Includes", "inc" => "Included", "not-inc" => "Not Included",
            "body" => "Tour Description: "
    ];
    ?>
@elseif($lang == "ru")
    <?php
    $trans = [
            "dai" => "День", "headline" => "Заголовок: ", "sub" => "Подпункт", "add-sub" => "+ Добавить Подпункт",
            "includes" => "Содержание Tура", "inc" => "В Тур Входит", "not-inc" => "В Тур He Входит",
            "body" => "Описание Тура: "
    ];
    ?>
@endif
@foreach($tour->tour_trans as $text)
       @if($text->lang->lang == $lang)
           @if($count_days == 3)
               <div class=""><span style="font-weight: bold">{{$trans['body']}}</span>
                   <div class="row">
                       {!! Form::textarea($lang . '_d' . $count_days, $text->d3 , ["class" => "summernote"]) !!}
                   </div>
               </div>
           @elseif($count_days == 7)
               <div class=""><span style="font-weight: bold">{{$trans['body']}}</span>
                   <div class="row">
                       {!! Form::textarea($lang . '_d' . $count_days, $text->d7 , ["class" => "summernote"]) !!}
                   </div>
               </div>
           @elseif($count_days == 10)
               <div class=""><span style="font-weight: bold">{{$trans['body']}}</span>
                   <div class="row">
                       {!! Form::textarea($lang . '_d' . $count_days, $text->d10 , ["class" => "summernote"]) !!}
                   </div>
               </div>
           @endif
       @endif
@endforeach