@extends('layouts.default')

@section('content')
    <div class="bg-image" style="background-image: url('img/various/bg01.jpg');">
        <div class="bg-primary-dark-op">
            <section class="content content-full content-boxed overflow-hidden">
                <!-- Section Content -->
                <div class="push-100-t push-50 text-center">
                    <h1 class="h2 text-white push-10 visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">New Movies</h1>
                </div>

                <!-- END Section Content -->
            </section>
        </div>
    </div>
    <div class="bg-gray-lighter">
        <section class="content content-boxed">
            <!-- New Arrivals -->
            <h3 class="font-w400 text-black push-30-t push-20">New Movies</h3>

            <div class="row">
                @foreach($new_movies as $media)
                    <div class="col-sm-6 col-lg-4">
                        <div class="block clear-background">
                            <div class="img-container ">
                                <?php $poster=($media->poster !=''? $media->poster: "img/photos/no-image-available-icon.jpg" ) ?>
                                <img class="img-responsive img-front" src="<?php echo $poster; ?>">
                                <div class="img-options">
                                    <div class="img-options-content">
                                        <div class="push-20">
                                            <a class="btn btn-sm btn-default" href="detail/{{$media->id}}">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="block-content">
                                <div class="push-10">
                                    <div class="h5 font-w600 text-success pull-right push-10-l">
                                      <?php
                                     if($media->rating==0) {
                                                        echo "No rating";
                                                }
                                                else{
                                                  for($i=1; $i<=$media->rating; $i++){
                                                        echo  "<i class='fa fa-star'></i>";
                                                    }
                                                 }
                                      ?>
                                     
                                  
                                  </div>

                                    <a class="h5" href="detail/{{$media->id}}"><?php echo substr($media->title,0,25); ?></a>

                                </div>
                                <?php $release=date("m/d/Y",strtotime($media->release_date));?>
                                <p class="text-muted">Release Date: <?php echo $release; ?></p>
                            </div>
                        </div>

                    </div>
                @endforeach


            </div>
            <div class="pull-right" >
                {{$new_movies->links()}}
            </div>
            <!-- END New Arrivals -->
        </section>
    </div>
@stop