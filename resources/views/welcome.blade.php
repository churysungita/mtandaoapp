@include('headerhome')
<!-- top bar ended here-- -->

   <!-- Carousel start -->
   @include('carousel')
   <!-- Carousel End -->


    <!-- About Start -->
   @include('about')
    <!-- About End -->


    <!-- Category Start -->
   @include('category')
    <!-- Category Start -->


    <!-- Courses Start -->
   @include('courses')
    <!-- Courses End -->


    <!-- Registration Start -->
   @include('registration')
    <!-- Registration End -->


    <!-- Team Start -->
   @include('team')
    <!-- Team End -->


    <!-- Testimonial Start -->
  @include('testimonial')
    <!-- Testimonial End -->


    <!-- Blog Start -->
    @include('blog')
    <!-- Blog End -->


    <!-- Footer Start -->
 @include('footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <!-- <script>
        // Disable right-click menu
        window.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });

        // Disable inspecting
        window.addEventListener('keydown', function (e) {
            if (e.ctrlKey && (e.key === 'I' || e.key === 'i' || e.keyCode === 73)) {
                e.preventDefault();
            }
        });

        // Disable taking screenshots
        window.addEventListener('keydown', function (e) {
            if (e.ctrlKey && e.shiftKey && (e.key === 'S' || e.key === 's' || e.keyCode === 83)) {
                e.preventDefault();
            }
        });

        // Disable screen recording
        navigator.mediaDevices.getDisplayMedia = null;

        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'u') {
                e.preventDefault();
                alert("You're note allowed please.");
            }
        });

    </script> -->
</body>

</html>