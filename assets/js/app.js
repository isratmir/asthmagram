 $(document).ready(function() {
      $('#more').click(function() {
        var tag   = $(this).data('tag'),
            maxid = $(this).data('maxid');
        
        $.ajax({
          type: 'GET',
          url: 'ajax.php',
          data: {
            tag: tag,
            max_id: maxid
          },
          dataType: 'json',
          cache: false,
          success: function(data) {
            // Output data
            $.each(data.dt, function(i) {
              $('.row').append('<div class="span4 box"><div class="padding"><img src="' + data.dt[i].images.standard_resolution.url + '"></div></div>');
            });
            
            // Store new maxid
            $('#more').data('maxid', data.next_id);
          }
        });
      });
    });