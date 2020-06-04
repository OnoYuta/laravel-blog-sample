@extends('frontend.layouts.app')

@section('content')
<article>
    <!-- article header-->
    <section class="container-fluid mb-5">
        <div class="row">
            <!-- article header img -->
            <div class="col-12 col-xl-8 px-0 bg-primary">
                <!-- <img src="{{ asset('images/header_post.jpg') }}" alt="post-list-header" class="article-header-img"> -->
                <img src="{{ asset('images/header_post.jpg') }}" alt="post-list-header" class="img-fluid">
            </div>
            <!-- article header content -->
            <div class="col-12 col-xl-4 bg-info">
                <div class="container py-5 text-white">
                    <span class="text-light">subtitle</span>
                    <h2 class="h2">The title of the recommended article</h2>
                    <p class="text-truncate">Display the text of the article, but omit it if the
                        number of characters does not fit in the line.</p>
                    <button type="button" class="btn btn-outline-light"><i
                            class="far fa-arrow-alt-circle-right"></i>&nbsp;Read more</button>
                </div>
            </div>
        </div>
    </section>

    <!-- article picks -->
    <section class="container mb-5">
        <!-- Three columns of text below the carousel -->
        <div class="row text-center">
            <div class="col-lg-4 pb-4">
                <i class="category-icon text-success mb-3 fas fa-code"></i>
                <h2>Category</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh
                    ultricies
                    vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent
                    commodo
                    cursus magna.</p>
                <p><a class="btn btn-warning" href="#" role="button">View details »</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4 pb-4">
                <i class="category-icon text-success mb-3 far fa-newspaper"></i>
                <h2>Category</h2>
                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                    Cras
                    mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor
                    mauris
                    condimentum nibh.</p>
                <p><a class="btn btn-warning" href="#" role="button">View details »</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4 pb-4">
                <i class="category-icon text-success mb-3 far fa-lightbulb"></i>
                <h2>Category</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id
                    ligula
                    porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum
                    nibh, ut
                    fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-warning" href="#" role="button">View details »</a></p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <div class="container py-5">
                    <h2 class="h2">First featurette heading.It’ll blow your
                        mind.</h2>
                    <p class="text-truncate">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula
                        porta felis
                        euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus,
                        tellus
                        ac cursus
                        commodo.</p>
                    <button type="button" class="btn btn-outline-success"><i
                            class="far fa-arrow-alt-circle-right"></i>&nbsp;Read
                        more</button>
                </div>
            </div>
            <div class="col-md-5 d-none d-md-block">
                <img src="{{ asset('images/header_post.jpg') }}" alt="post-list-header" class="post-thumb">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <div class="container py-5">
                    <h2 class="h2">First featurette heading.It’ll blow your
                        mind.</h2>
                    <p class="text-truncate">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula
                        porta felis
                        euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus,
                        tellus
                        ac cursus
                        commodo.</p>
                    <button type="button" class="btn btn-outline-success"><i
                            class="far fa-arrow-alt-circle-right"></i>&nbsp;Read
                        more</button>
                </div>
            </div>
            <div class="col-md-5 d-none d-md-block order-md-1">
                <img src="{{ asset('images/header_post.jpg') }}" alt="post-list-header" class="post-thumb">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <div class="container py-5">
                    <h2 class="h2">First featurette heading.It’ll blow your
                        mind.</h2>
                    <p class="text-truncate">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula
                        porta felis
                        euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus,
                        tellus
                        ac cursus
                        commodo.</p>
                    <button type="button" class="btn btn-outline-success"><i
                            class="far fa-arrow-alt-circle-right"></i>&nbsp;Read
                        more</button>
                </div>
            </div>
            <div class="col-md-5 d-none d-md-block">
                <img src="{{ asset('images/header_post.jpg') }}" alt="post-list-header" class="post-thumb">
            </div>
        </div>

        <!-- /END THE FEATURETTES -->

    </section>
</article>
@endsection