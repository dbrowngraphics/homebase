<!-- base vendor bundle: 
    DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
    + pace.js (recommended)
    + jquery.js (core)
    + jquery-ui-cust.js (core)
    + popper.js (core)
    + bootstrap.js (core)
    + slimscroll.js (extension)
    + app.navigation.js (core)
    + ba-throttle-debounce.js (core)
    + waves.js (extension)
    + smartpanels.js (extension)
    + src/../jquery-snippets.js (core) 
-->

<script src="{{asset('js/vendors.bundle.js')}}"></script>
<script src="{{asset('js/app.bundle.js')}}"></script>

<script>
    $(document).ready(function() {
        let height = $('#page-logo').height();
        $('#page-header').height(height);
    });

</script>
