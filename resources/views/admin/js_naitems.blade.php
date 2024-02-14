<script>
        $(document).ready(function () {
            // Add an event listener for each menu item
            $('#dashboard-link').click(function () {
                // Toggle the collapse state of the associated submenu
                $('#ui-basic1').collapse('hide');
                $('#ui-basic2').collapse('hide');
                $('#ui-basic3').collapse('hide');
                $('#ui-basic4').collapse('hide');
                $('#ui-basic5').collapse('hide');
                $('#ui-basic6').collapse('hide');
                $('#ui-basic7').collapse('hide');
            });

            $('#manage-users-link').click(function () {
                $('#ui-basic1').collapse('toggle');
            });

            $('#manage-classes-link').click(function () {
                $('#ui-basic2').collapse('toggle');
            });

            $('#manage-subjects-link').click(function () {
                $('#ui-basic3').collapse('toggle');
            });

            $('#manage-topics-link').click(function () {
                $('#ui-basic4').collapse('toggle');
            });

            $('#manage-subtopics-link').click(function () {
                $('#ui-basic5').collapse('toggle');
            });

            $('#manage-contents-link').click(function () {
                $('#ui-basic6').collapse('toggle');
            });

            $('#manage-posts-link').click(function () {
                $('#ui-basic7').collapse('toggle');
            });

            // Add event listeners for other menu items as needed
        });
    </script>