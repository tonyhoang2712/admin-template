var CLNGfaq = function () {

    let faqCollapseList = function () {
      $(".list-group-item-question-head").click( function() {
          let show = $(this).hasClass('collapsed');
          if(show) {
            $(this).find('.list-group-item-circle').removeClass('rotate180');
          } else {
            $(this).find('.list-group-item-circle').addClass('rotate180');
          }

      });
    };

    let showPharagraph = function () {
        $('.daily-job__see-more').click(function() {
            var _parent = $(this).parents('.content');
            _parent.find('.desc-short').hide();
            _parent.find('.desc-pharagraph').show(100);
            _parent.find('.daily-job__hide').show();
        });
    };

    let hidePharagraph = function () {
        $('.daily-job__hide').click(function() {
            var _parent = $(this).parents('.content');
            _parent.find('.desc-short').show();
            _parent.find('.desc-pharagraph').hide(100);
            _parent.find('.daily-job__hide').hide();
        });
    };

    let openNewsPopup = function() {
        $('.see-more-news').click(function() {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.toggle();
        })
    }


    return {
      init: function () {
        faqCollapseList();
        showPharagraph();
        hidePharagraph();
        openNewsPopup();
      }
    }
  }();


  $(document).ready(function () {
    CLNGfaq.init()
  });
