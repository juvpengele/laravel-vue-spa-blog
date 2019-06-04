<template>
    <div class="row col-md-8">
        <div class="col-sm-12 col-md-12 row mt-2">
            <div class="col-md-12 blog-main">
                <div class="blog-img mb-4 text-center">
                    <img src="https://picsum.photos/600/300" alt="" class="w-100" style="max-height: 300px;">
                </div>

                <div class="blog-post">
                    <h2 class="blog-post-title">Sample blog post</h2>
                    <p class="blog-post-meta">January 1, 2014 by <a href="#">Mark</a></p>

                    <p>This blog post shows a few different types of content that’s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p>
                    <hr>
                    <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
                    <blockquote>
                        <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </blockquote>
                    <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                    <h2>Heading</h2>
                    <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <h3>Sub-heading</h3>
                    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                    <pre><code>Example code block</code></pre>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
                    <h3>Sub-heading</h3>
                </div><!-- /.blog-post -->
            </div>
            <!-- comments -->
            <div class="comment-form col-md-12 border-top pt-4">
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Your name" id="name">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Your email" id="email">
                    </div>
                    <div class="form-group col-md-12">
                        <textarea class="form-control" id="Your comment" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-success">Comment</button>
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="card mb-3 col-md-12 p-0 shadow-sm">
                        <div class="card-header d-flex justify-content-between m-0">
                            <span>John Doe</span>
                            <span class="text-secondary">2 mins ago</span>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End comments -->
        </div>

    </div>

</template>

<script>
    export default {
        name: "PostShow"
    }
</script>

<style scoped>

</style>