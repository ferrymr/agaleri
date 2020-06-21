</div>
<!-- PAGE FOOTER -->
<div class="page-footer">
  <div class="row">
    <div class="col-xs-12 col-sm-6">
      @php
      $name_app = \App\Param::select('name_aplikasi','name_perusahaan','copyright_year')->limit(1)->get();
      @endphp
      <span class="txt-color-white">{{ $name_app[0]->name_aplikasi }}<span class="hidden-xs"> - License to {{ $name_app[0]->name_perusahaan }}</span> © {{ $name_app[0]->copyright_year }}</span>
    </div>
  </div>
</div>
<!-- END PAGE FOOTER -->

<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
Note: These tiles are completely responsive,
you can add as many as you like
-->
<div id="shortcut">
  <ul>
    <li>
      <a href="inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
    </li>
    <li>
      <a href="calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
    </li>
    <li>
      <a href="gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
    </li>
    <li>
      <a href="invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
    </li>
    <li>
      <a href="gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
    </li>
    <li>
      <a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
    </li>
  </ul>
</div>
<!-- END SHORTCUT AREA -->

<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="{{ asset('template/js/plugin/pace/pace.min.js') }}"></script>
<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  var s = '{{ asset("temp/js/libs/jquery-3.2.1.min.js") }}';
  if (!window.jQuery) {
    document.write('<script src="' + s + '"><\/script>');
  }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
  var s = '{{ asset("temp/js/libs/jquery-ui.min.js") }}';
  if (!window.jQuery.ui) {
    document.write('<script src="' + s + '"><\/script>');
  }
</script>
<!-- IMPORTANT: APP CONFIG -->
<script src="{{ asset('template/js/app.config.js') }}"></script>

<!-- TERBILANG -->
<script src="{{ asset('js/terbilang.js') }}"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="{{ asset('template/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js') }}"></script>

<!-- BOOTSTRAP JS -->
<script src="{{ asset('template/js/bootstrap/bootstrap.min.js') }}"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="{{ asset('template/js/notification/SmartNotification.min.js') }}"></script>

<!-- JARVIS WIDGETS -->
<script src="{{ asset('template/js/smartwidgets/jarvis.widget.min.js') }}"></script>

<!-- EASY PIE CHARTS -->
<script src="{{ asset('template/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js') }}"></script>

<!-- SPARKLINES -->
<script src="{{ asset('template/js/plugin/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- JQUERY VALIDATE -->
<script src="{{ asset('template/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>

<!-- JQUERY MASKED INPUT -->
<script src="{{ asset('template/js/plugin/masked-input/jquery.maskedinput.min.js') }}"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="{{ asset('template/js/plugin/select2/select2.min.js') }}"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="{{ asset('template/js/plugin/bootstrap-slider/bootstrap-slider.min.js') }}"></script>

<!-- browser msie issue fix -->
<script src="{{ asset('template/js/plugin/msie-fix/jquery.mb.browser.min.js') }}"></script>

<!-- FastClick: For mobile devices -->
<script src="{{ asset('template/js/plugin/fastclick/fastclick.min.js') }}"></script>

<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- Demo purpose only -->
<!-- <script src="{{ asset('template/js/demo.min.js') }}"></script> -->

<!-- MAIN APP JS FILE -->
<script src="{{ asset('template/js/app.min.js') }}"></script>

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
<script src="{{ asset('template/js/speech/voicecommand.min.js') }}"></script>

<!-- SmartChat UI : plugin -->
<script src="{{ asset('template/js/smart-chat-ui/smart.chat.ui.min.js') }}"></script>
<script src="{{ asset('template/js/smart-chat-ui/smart.chat.manager.min.js') }}"></script>

<!-- SWEETALERT JS -->
<script src="{{ asset('sweet_alert/sweetalert2.all.js') }}"></script>

<!-- PAGE RELATED PLUGIN(S) -->
<script src="{{ asset('template/js/plugin/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/datatables/dataTables.colVis.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/datatables/dataTables.tableTools.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/datatable-responsive/datatables.responsive.min.js') }}"></script>

<!-- VALIDATOR  -->
<script src="{{ asset('assets/validator/validator.min.js') }}"></script>

<!-- NUMERAL  -->
<script src="{{ asset('js/numeral.min.js') }}"></script>

<!-- DATERANGE -->
<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/daterangepicker.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}" />

<script src="{{ asset('template/js/plugin/superbox/superbox.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/highChartCore/highcharts-custom.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/highchartTable/jquery.highchartTable.min.js') }}"></script>

<!-- PAGE RELATED PLUGIN(S) -->
<script src="{{ asset('template/js/plugin/ckeditor/ckeditor.js') }}"></script>

<script>
  // DO NOT REMOVE : GLOBAL FUNCTIONS!
  setTimeout(function() {
    $(document).ready(function() {

      pageSetUp();

      // PAGE RELATED SCRIPTS

      $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
      $('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span').attr('title', 'Collapse this branch').on('click', function(e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(':visible')) {
          children.hide('fast');
          $(this).attr('title', 'Expand this branch').find(' > i').removeClass().addClass('fa fa-lg fa-plus-circle');
        } else {
          children.show('fast');
          $(this).attr('title', 'Collapse this branch').find(' > i').removeClass().addClass('fa fa-lg fa-minus-circle');
        }
        e.stopPropagation();

      });

    })
  }, 1000);


  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var baseurl = '{{ url('/') }}';

  // $(".disabled").css('display','none');

  // $(".disabled").click(function() {
  //   return false;
  // });


  function sendAjax(url, type, data) {
    senddata(url, type, data);
  }

  function senddata(url, type, data) {
    $.ajax({
      type: type,
      url: baseurl + url,
      data: data,
      success: function(data) {
        console.log('data rsp ajax : ' + data);
        window.location.reload();
      }
    });
  }

  function senddata2(url, type, data) {
    $.ajax({
      type: type,
      url: baseurl + url,
      data: data,
      success: function(data) {
        console.log('data rsp ajax : ' + data);
        // window.location.reload();
      }
    });
  }
</script>


<!-- BASE FUNCTION AZHTECH  -->
<script src="{{ asset('js/basefunction.js') }}"></script>
<script src="{{ asset('js/accountingfunction.js') }}"></script>


</div>



</body>

</html>