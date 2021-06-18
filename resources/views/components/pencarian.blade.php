 <!-- slider Area Start-->
<div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="slider-active">
        <div class="single-slider hero-overly slider-height d-flex align-items-center" data-background="{{url('assets/utama/img/hero/h1_hero.jpg')}}">
            <div class="container">
                <!-- Search Box -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- form -->
                        <form action="/" class="search-box" method="post">
                            @csrf
                            <div class="input-form mb-30">
                                <input type="text" placeholder="When Would you like to go ?" name="pencarian" value="{{old('pencarian')}}">
                            </div>
                            <div class="search-form mb-30 mr-4">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>