<script src="{{ asset('Backend/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('Backend/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Backend/assets/js/feather.min.js') }}"></script>
<script src="{{ asset('Backend/assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('Backend/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('Backend/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('Backend/assets/plugins/apexchart/chart-data.js') }}"></script>
<script src="{{ asset('Backend/assets/js/script.js') }}"></script>
<script src="{{ asset('Backend/assets/js/toaster.min.js') }}"></script>
<script src="{{ asset('Backend/assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('Backend/assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('Backend/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
  $(document).ready(function() {
  var keyCount = 0;
  var timeout;

  $(document).on('keydown', function(e) {
    // Check if the pressed key is the space key
    if (e.keyCode === 32) {
      keyCount++;

      // Clear the previous timeout
      clearTimeout(timeout);

      // Set a new timeout to reset the key count
      timeout = setTimeout(function() {
        keyCount = 0;
      }, 1000); // Adjust the timeout value as needed (in milliseconds)

      // Check if the key has been pressed twice
      if (keyCount === 2) {
        // Trigger a click event on the button
        $('#addmore').trigger('click');
      }
    }
  });

//   // Handle button click event
//   $('#addmore').on('click', function() {
//     // Add your logic here for when the button is clicked
//     console.log('Button clicked');
//   });
});
</script>

{{-- <script>
  $(document).ready(function() {
    $('#myDropdown').select2();
  });
  </script> --}}
@yield('password_changed')