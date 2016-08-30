

        <script> $(document).ready( function() {

        $('.thumbnail-item').hover( function() {
            $(this).find('.thumbnail-detail').fadeIn(300);
            }, 
                                   function() {
            $(this).find('.thumbnail-detail').fadeOut(100);
        });
    
        $('#commentbody').click(function(){

            $(".summit-comment").show();
        } );
    
        $('.cancel-comment').click(function(){

            $(".summit-comment").hide();
        } );
    
    
    
       });
            
       

    </script>  
      


</body>

</html>
