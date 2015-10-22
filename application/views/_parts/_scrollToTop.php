<script>
  $(function (){
    $("#click").click(function (){
      $('html, body').animate({
        scrollTop: $("body").offset().top
      }, 2000);
    });
  });
</script>