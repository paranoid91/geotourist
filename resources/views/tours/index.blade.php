@extends("ancestor")

@section('title') {{ trans("main.tours") }} @endsection

@section("css")
	<link href="{{ asset('/css/tours.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section("content")
<div class="content-tours">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" style="padding-right:20px">
				@foreach($tours as $tour)
					@for($i = 0; $i < count($tour->tour_trans); $i++)
						@if($tour->tour_trans[$i]->lang_id == $lang[0]->id)
							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 tour-wrapper">
									<div class="col-sm-4 col-md-4 col-lg-4 tour-wrapper-image no-padding">
										@if(isset($boss_mode) && $boss_mode === true)
											<a href="{{ action('AdminToursController@showFilter', ["id" => $tour->id]) }}">
												<img src="{{ asset($tour->list_img) }}">
											</a>
										@else
											<a href="{{ action('ToursController@show', ["id" => $tour->id]) }}" style="background-image: url({{ asset($tour->paralax_img) }})" class="lst-img-wr">
												

@if($tour->sticker == 1)
                                                   <div class="atlist__item__angle" style="background-color:#01cb68">{{ trans("main.forsale") }}</div>
                                               @elseif($tour->sticker == 2)
                                                   <div class="atlist__item__angle" style="background-color:#eb4293">{{ trans("main.upcmg") }}</div>
                                               @endif
											</a>
										@endif
									</div>
									<div class="col-sm-5 col-md-5 col-lg-5">
										<div class="tour-txt-fx-wd">
											<h2 class="tour-h2-new">{{ $tour->tour_trans[$i]->title }}</h2>
											<p>{!! $tour->tour_trans[$i]->short_description !!}</p>
										</div>
										@if($tour->tour_type==0)
											@if($tour->tour_trans[$i]->d3)
												@if($tour->tour_trans[$i]->d3_num != 0)
													<div class="times">
														<a href="{{ action('ToursController@show', ["id" => $tour->id . "scn3"]) }}">
                                                           <span class="span-time">
                                                               <span class="glyphicon glyphicon-time gl-tm-tour"></span>
                                                               <span class="time-fn">
                                                                   &nbsp;{{ $tour->tour_trans[$i]->d3_num }} {{ trans("tours.day") }}
                                                               </span>
                                                           </span>
														</a>
													</div>
												@endif
											@endif
											@if($tour->tour_trans[$i]->d7)
												@if($tour->tour_trans[$i]->d7_num != 0)
													<div class="times">
														<a href="{{ action('ToursController@show', ["id" => $tour->id . "scn7"]) }}">
                                                           <span class="span-time">
                                                               <span class="glyphicon glyphicon-time gl-tm-tour"></span>
                                                               <span class="time-fn">
                                                                   &nbsp;{{ $tour->tour_trans[$i]->d7_num }} {{ trans("tours.day") }}
                                                               </span>
                                                           </span>
														</a>
													</div>
												@endif
											@endif
											@if($tour->tour_trans[$i]->d10)
												@if($tour->tour_trans[$i]->d10_num != 0 )
													<div class="times">
														<a href="{{ action('ToursController@show', ["id" => $tour->id . "scn10"]) }}">
                                                           <span class="span-time">
                                                               <span class="glyphicon glyphicon-time gl-tm-tour"></span>
                                                               <span class="time-fn">
                                                                   &nbsp;{{ $tour->tour_trans[$i]->d10_num }} {{ trans("tours.day") }}
                                                               </span>
                                                           </span>
														</a>
													</div>
												@endif
											@endif
										@elseif($tour->tour_type==1)
											@if($tour->sp_tour_num != 0 && $tour->tour_trans[$i]->d10)
												<div class="times">
													<a href="{{ action('ToursController@show', ["id" => $tour->id . "scn10"]) }}">
                                                       <span class="span-time">
                                                           <span class="glyphicon glyphicon-time gl-tm-tour"></span>
                                                           <span class="time-fn">
                                                               &nbsp;{{ $tour->sp_tour_num }} {{ trans("tours.day") }}
                                                           </span>
                                                       </span>
													</a>
												</div>
											@endif
										@endif
									</div>
									<div class="col-sm-3 col-md-3 col-lg-3 txt-wrapper">
										<div class="txt-wt-link">
											@if(($mark = getTourStarts($tour->id)) > 0)
												<span class="stars">
                                                @for($i = 1; $i <= $mark; $i++)
														<span class="glyphicon glyphicon-star"></span>
													@endfor
                                                </span>
											@else
												<span class="glyphicon glyphicon-star" style="color: transparent; text-shadow: 0px 0px 3px rgba(224, 224, 224, 1);"></span>
												<span class="glyphicon glyphicon-star" style="color: transparent; text-shadow: 0px 0px 3px rgba(224, 224, 224, 1);"></span>
												<span class="glyphicon glyphicon-star" style="color: transparent; text-shadow: 0px 0px 3px rgba(224, 224, 224, 1);"></span>
												<span class="glyphicon glyphicon-star" style="color: transparent; text-shadow: 0px 0px 3px rgba(224, 224, 224, 1);"></span>
												<span class="glyphicon glyphicon-star" style="color: transparent; text-shadow: 0px 0px 3px rgba(224, 224, 224, 1);"></span>
											@endif
											@if(count($tour->reviews) > 0)
												<div class="rev-count">
													<span>{{ count($tour->reviews) }}</span>
													<span class="revcount-sp">{{ (count($tour->reviews) > 1 ? trans("main.revcounts") : trans("main.revcount")) }}</span>
												</div>
											@else
												<div class="rev-count">
													<span class="revcount-sp">0 {{ trans("main.revcount") }}</span>
												</div>
											@endif
											@if(!empty($tour->price))
												<div class="price-new">
													<span class="price-is">{{ $tour->price }}</span><br>
													<span class="price-per">{{ trans("main.per-per") }}</span>
												</div>
											@endif
										</div>
										@if(isset($boss_mode) && $boss_mode === true)
											<a href="{{ action('AdminToursController@showFilter', ["id" => $tour->id]) }}" class="tour-button text-center">{{ trans("main.view-more") }}</a>
										@else
											<div class="link-wr">
												<a href="{{ action('ToursController@show', ["id" => $tour->id]) }}" class="tour-button text-center">{{ trans("main.view-more") }}</a>
											</div>
										@endif
									</div>
								</div>
							</div>
						@endif
					@endfor
				@endforeach
				<div class="pagination-wrapper">
					{!! $tours->render() !!}
				</div>
			</div>
			@include("ad", ["class" => "list-tr-ad"])
		</div>
	</div>
</div>
@endsection
