@extends('layouts.default')
@section('content')
    <script>

        $(document).ready(function(){
            $("#rating").click(function(){
                var score= $("#rating").raty('score');
                $("#score").val(score);
            });

            $(".watchlist").click(function(){
                var val=$("#mediaID").val();
                var host = window.location.host;

                $.ajax({
                    type: "GET",
                    crossDomain: false,
                    url: 'http://192.81.134.71/Bingewatch/public/watchlist/'+val,
                    success:function(data){
                        $(" <div class='alert alert-success'><p><i class='fa fa-check'></i> The media successfully added to your watchinglist</p></div>").prependTo(".alert");
                    }
                });
            });

        });



    </script>

    <div class="bg-gray-lighter">
        <section class="content content-boxed">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Buttons which toggles side nav content content in smaller screens -->
                    <!-- Toggle class helper (for .js-nav-content below), functionality initialized in App() -> uiToggleClass() -->
                    <div class="block hidden-lg">
                        <div class="block-content">
                            <button class="btn btn-sm btn-block btn-default push" type="button" data-toggle="class-toggle" data-target=".js-nav-content" data-class="visible-lg">
                                <i class="fa fa-list-ul push-5-r"></i> Navigation
                            </button>
                        </div>
                    </div>
                    <h3>Casts</h3>
                    <div class="block">
                        @foreach($casts as $cast)
                            <a class="block block-link-hover3 block-transparent remove-margin-b" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="pull-right">
                                        <?php $profile=($cast->profile !=''? $cast->profile : "../img/photos/no-image-available-icon.jpg" )?>
                                        <img class="img-avatar" src="<?php echo url($profile);?>" alt="">
                                    </div>
                                    <div class="pull-left push-10-t">
                                        <div class="font-w600 push-5">{{$cast->cast_name}}</div>
                                        <div class="text-muted">{{$cast->cast_character}}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <h3>Staffs</h3>

                    <div class="block">
                        @foreach($director as $d)
                            <a class="block block-link-hover3 block-transparent remove-margin-b" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="pull-right">
                                        <?php $profile=($d->profile !=''? $d->profile: "../img/photos/no-image-available-icon.jpg" )?>
                                        <img class="img-avatar" src="<?php echo url($profile); ?>" alt="">
                                    </div>
                                    <div class="pull-left push-10-t">
                                        <div class="font-w600 push-5">{{$d->cast_name}}</div>
                                        <div class="text-muted">{{$d->job}}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        @foreach($staffs as $staff)
                            <a class="block block-link-hover3 block-transparent remove-margin-b" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="pull-right">
                                        <?php $profile=($staff->profile !=''? $staff->profile: "../img/photos/no-image-available-icon.jpg" )?>
                                        <img class="img-avatar" src="<?php echo url($profile) ;?>" alt="">
                                    </div>
                                    <div class="pull-left push-10-t">
                                        <div class="font-w600 push-5">{{$staff->cast_name}}</div>
                                        <div class="text-muted">{{$staff->job}}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach


                    </div>
                </div>
                <h3>Movie Detail</h3>
                <div class="col-lg-9">
                    <!-- Product -->
                    <div class="block alert">
                        <div class="block-content">

                            <div class="row items-push">
                                <div class="col-sm-6">
                                    <!-- Images -->
                                    <div class="row js-gallery">
                                        <div class="col-xs-12 push-10">
                                            <a class="img-link" href="{{url($movie_detail->poster)}}">
                                                <img class="img-responsive" src="{{url($movie_detail->poster)}}">
                                            </a>
                                        </div>

                                        <div class="col-xs-4">

                                            <h4>Trailers</h4>


                                        </div>

                                    </div>
                                    <!-- END Images -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- Vital Info -->
                                    <div class="clearfix">
                                        <div class="pull-right">
                                            <span class="h2 font-w700 text-success">     
                                             <?php
                                                if($movie_detail->rating==0) {
                                                        echo "No rating";
                                                }
                                                else{
                                                  for($i=1; $i<=$movie_detail->rating; $i++){
                                                        echo  "<i class='fa fa-star'></i>";
                                                    }
                                                 }
                                                  ?>

                                          
                                          </span>
                                        </div>
                                      <!--  <span class="h5">
                                                        <span class="font-w600 text-success">Rating</span>
                                                    </span>-->
                                    </div>
                                    <hr>
                                    Status:
                                    <div class="pull-right">
                                        <?php if($movie_detail->release_date > date('Y-m-d')) echo "Upcoming"; else echo"Released";  ?>
                                    </div>
                                    @if(\Auth::check())
                                    <hr>
                                    <button type="submit" class="btn btn-sm btn-primary watchlist"><i class="fa fa-plus push-5-r"></i> Add to WatchList </button>
                                    @endif
                                    <hr>
                                    <p>{{$movie_detail->description}}</p>
                                    <!-- END Vital Info -->
                                </div>

                                <div class="col-xs-12">
                                    <?php

                                        if($trailers !=null) {
                                            $val=explode(",",$trailers->source);

                                        ?>
                                    @foreach($val as $v)
                                        <div class="col-xs-4">

                                            <a href="" data-toggle="modal" data-target="#{{$v}}"><img src="http://img.youtube.com/vi/{{$v}}/hqdefault.jpg" height="250" width="270" border="10"></a>


                                        </div>
                                    @endforeach

                                </div>

                                <!-- Normal Modal -->
                                @foreach($val as $v)
                                    <div class="modal" id="{{$v}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="block block-themed block-transparent remove-margin-b">
                                                    <div class="block-header bg-primary-dark">
                                                        <ul class="block-options">
                                                            <li>
                                                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                                            </li>
                                                        </ul>
                                                        <h3 class="block-title">Trailer</h3>
                                                    </div>
                                                    <div class="block-content">

                                                        <iframe width="560" height="426" src="https://www.youtube.com/embed/{{$v}}" frameborder="0" allowfullscreen></iframe>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                            <?php
                            }

                            ?>

                            <!-- END Normal Modal -->

                                <div class="col-xs-12">
                                    <!-- Extra Info -->
                                    <div class="block">
                                        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                                            <li class="active">
                                                <a href="#info">Info</a>
                                            </li>
                                            <li>
                                                <a href="#reviews" aria-controls="#reviews" role="tab" data-toggle="tab">Reviews</a>
                                            </li>
                                        </ul>
                                        <div class="block-content tab-content">
                                            <!-- Info -->
                                            <div class="tab-pane pull-r-l active" id="info">
                                                @if(session('status'))
                                                    <div class="alert alert-success alert-dismissable">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <p>{{session('status')}}</p>
                                                    </div>
                                                @endif
                                                <table class="table table-striped table-borderless remove-margin-b">
                                                    <thead>
                                                    <tr>
                                                        <th colspan="2">Information</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td style="width: 20%;">Status</td>
                                                        <td>
                                                            <?php
                                                            if($movie_detail->release_date > date('Y-m-d')) echo "Upcoming";
                                                            else echo "Released";
                                                            ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Studio</td>
                                                        <td>
                                                            {{$companies->production_companies}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Genres</td>
                                                        <td>
                                                            {{$genres->genre_type}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Duration
                                                        <td>
                                                            <?php $hr = floor($movie_detail->runtime/60); $min=$movie_detail->runtime%60;
                                                            echo $hr." hr ".$min." mins";
                                                            ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rating</td>
                                                        <td>
                                                          <?php
                                                           if($movie_detail->rating==0) {
                                                              echo "No rating";
                                                            }
                                                            else{
                                                              for($i=1; $i<=$movie_detail->rating; $i++){
                                                                echo  "<i class='fa fa-star'></i>";
                                                              }
                                                           }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                            <!-- END Info -->


                                            <!-- Reviews -->
                                            <div class="tab-pane pull-r-l" id="reviews">
                                                <!-- Average Rating -->
                                                <div class="block block-rounded">

                                                </div>
                                                <!-- END Average Rating -->

                                                <!-- Ratings -->
                                                @foreach($reviews as $review)
                                                    <div class="media push-15">
                                                        <div class="media-left">
                                                            <a href="javascript:void(0)">
                                                                <img class="img-avatar img-avatar32" src="../img/avatars/avatar10.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="media-body font-s13">

                                                            <?php
                                                            $val=$review->review_rating;
                                                            echo "<span class='text-warning''>";
                                                            for($i=1; $i<=$val; $i++){
                                                                echo "<i class='fa fa-star'></i>";
                                                            }
                                                            echo "</span>";
                                                            ?>

                                                            <a class="font-w600" href="javascript:void(0)">{{$review->author}}</a>
                                                            <div class="push-5">{{$review->review_content}}</div>
                                                            <div class="font-s12">
                                                                <span class="text-muted"><em>2 hours ago</em></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endforeach

                                            <!-- END Ratings -->


                                                <!-- Simple Rating -->

                                                <!-- END Simple Rating -->

                                                <div class="block">

                                                    <div class="block-content">
                                                        @if(!\Auth::check())
                                                            <a href="{{url('/login',[$movie_detail->id])}}"> <button class="btn btn-info" >Must Register to Post a Review</button></a>
                                                        @elseif(\Auth::check())
                                                            <form class="form-horizontal" method="post" action="{{url('/review')}}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="user" value="{{(Auth::user()->email)}}" id="user">
                                                                <input type="hidden" name="mediaID" value="{{$movie_detail->id}}" id="mediaID">
                                                                <div class="form-group">
                                                                    <div class="col-xs-12">
                                                                        <!-- SimpleMDE Container -->
                                                                        <textarea class="js-simplemde" id="simplemde" name="review_content">Leave your review here!</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="block">
                                                                    <div class="block-content block-content-full">
                                                                        <p>How many stars will you give for this movie </p>

                                                                        <!-- Rating Container -->
                                                                        <div class="js-rating" id="rating"></div>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-xs-12">
                                                                        <button class="btn btn-sm btn-primary" id="send">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END Reviews -->
                                        </div>
                                    </div>
                                    <!-- END Extra Info -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Product -->
            </div>
    </div>
    </section>
    </div>
    <!-- Page JS Code -->

@stop

<!-- END Side Content and Product -->
