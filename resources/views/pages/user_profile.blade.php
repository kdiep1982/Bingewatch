@extends('layouts.default')
@section('content')


    <!-- Main Container -->

        <!-- Page Content -->
        <div class="content content-boxed">
            <!-- User Header -->
            <div class="block">
                <!-- Basic Info -->
                <div class="bg-image" style="background-image: url('img/photos/photo6@2x.jpg');">
                    <div class="block-content bg-primary-dark-op text-center overflow-hidden">
                        <div class="push-30-t push animated fadeInDown">
                            <img class="img-avatar img-avatar96 img-avatar-thumb" src="img/avatars/avatar4.jpg" alt="">
                        </div>
                        <div class="push-30 animated fadeInUp">
                            <h2 class="h4 font-w600 text-white push-5">{{Auth::user()->name}}</h2>

                        </div>
                    </div>
                </div>
                <!-- END Basic Info -->

                <!-- Stats -->
                <div class="block-content text-center">
                    <div class="row items-push text-uppercase">
                        <div class="col-xs-6 col-sm-3">
                            <div class="font-w700 text-gray-darker animated fadeIn">Movie Reviews</div>
                            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">{{$movie_reviews}}</a>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="font-w700 text-gray-darker animated fadeIn">TV Show Reviews</div>
                            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">{{$tv_reviews}}<a>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="font-w700 text-gray-darker animated fadeIn">Anime Reviews</div>
                            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">2600</a>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="font-w700 text-gray-darker animated fadeIn">Average Rating Ratings</div>
                            <div class="text-warning push-10-t animated flipInX">
                                <?php
                                    $counter=0;
                                    $review_count=count($review_ratings);
                                    if($review_count!=0) {
                                        foreach ($review_ratings as $rating)
                                        {
                                            $counter += (int)$rating->review_rating;
                                        }
                                        $overall_ratings=$counter/count($review_ratings);
                                        for($i=1; $i<=$overall_ratings; $i++){
                                            echo  "<i class='fa fa-star'></i>";
                                        }
                                    }
                                    else{
                                        echo "No reviews yet";
                                    }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Stats -->
            </div>
            <!-- END User Header -->

            <!-- Main Content -->
            <div class="row">
                <div class="col-sm-5 col-sm-push-7 col-lg-4 col-lg-push-8">
                    <!-- Follow -->
                    <div class="block">
                        <div class="block-content block-content-full text-center">
                            <button class="btn btn-sm btn-default"><i class="fa fa-fw fa-plus text-success"></i> Follow</button>
                            <button class="btn btn-sm btn-default"><i class="fa fa-fw fa-inbox text-info"></i> Send Message</button>
                        </div>
                    </div>
                    <!-- END Follow -->

                    <!-- About -->
                    <div class="block">
                        <div class="block-content">
                            <p>Hi there, welcome to my profile!</p>
                            <p>I'm a web designer and I love creating stuff that solve problems and make your life easier. Feel free to follow me to know more about me and my projects. Thanks for stopping by, wish you a great day!</p>
                        </div>
                    </div>
                    <!-- END About -->

                    <!-- Ratings -->
                    <div class="block block-opt-refresh-icon6">
                        <div class="block-header">
                            <ul class="block-options">
                                <li>
                                    <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title"><i class="fa fa-fw fa-star"></i> My Ratings</h3>
                        </div>
                        <div class="block-content">
                            <ul class="list list-simple">
                                <?php
                                    $counter=0;
                                    $review_count=count($review_ratings);
                                    if($review_count!=0) {
                                        foreach ($review_ratings as $rating)
                                        {
                                           ?>
                                            <li>
                                            <div class="push-5 clearfix">
                                                <div class="text-warning pull-right">
                                                    <?php for($i=0; $i<$rating->review_rating; $i++)
                                                        echo "<i class='fa fa-star'></i>";
                                                    ?>
                                                </div>
                                                <a class="font-w600" href="detail/{{$rating->id}}">{{$rating->title}}</a>

                                            </div>
                                            <div class="font-s13">{{$rating->review_content}}</div>
                                        </li>
                                       <?php
                                        }
                                    }
                                    else{
                                      echo "No reviews yet";
                                    }
                                ?>
                            </ul>
                            <div class="text-center push">
                                <small>{{$review_ratings->links()}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- END Ratings -->
                </div>
                <div class="col-sm-7 col-sm-pull-5 col-lg-8 col-lg-pull-4">
                    <!-- Timeline -->
                    <div class="block block-opt-refresh-icon6">
                        <div class="block-header">

                            <h3 class="block-title"><i class="glyphicon-folder-open"></i> My Watchlist</h3>
                        </div>
                        <div class="block-content">
                            <div class="block block-transparent pull-r-l">
                                <div class="block-content block-content-full">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">#</th>
                                            <th>Title</th>
                                            <th>Rating</th>
                                            <th class="hidden-xs" style="width: 15%;">Type</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $counter =1;
                                            foreach($user_watchlist as $watchlist){
                                               echo "<tr>";
                                            echo "<td class='text-center'>".$counter."</td>";
                                            echo "<td><a href='detail/$watchlist->id'>$watchlist->title</a></td>";
                                            if($watchlist->rating==0) {
                                                        echo "<td>No Rating</td>";
                                                }
                                                else{
                                                  echo "<td>";
                                                  for($i=1; $i<=$watchlist->rating; $i++){
                                                        echo  "<i class='fa fa-star'></i>";
                                                    }
                                                  echo "</td>";
                                                 }
                                           
                                            if($watchlist->type=="Movie"){
                                                echo "<td class='hidden-xs'><span class='label label-warning'>$watchlist->type</span></td>";
                                            }
                                            elseif ($watchlist->type="TV"){
                                                echo "<td class='hidden-xs'><span class='label label-info'>$watchlist->type</span></td>";
                                            }
                                            elseif ($watchlist->type="Anime"){
                                                echo "<td class='hidden-xs'><span class='label label-success'>$watchlist->type</span></td>";
                                            }
                                            echo "</tr>";

                                            $counter ++;
                                            }
                                        ?>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Timeline -->
                </div>
            </div>
            <!-- END Main Content -->
        </div>

@stop