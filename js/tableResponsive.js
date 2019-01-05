$(document).ready(function(){
    $('.js-table-data td').each(function(){
      var tdIndex = $(this).index();
      if ($('tr').find('th').eq(tdIndex).attr('data-label')) {
        var thText = $('tr').find('th').eq(tdIndex).data('label');
      } else {
        var thText = $('tr').find('th').eq(tdIndex).text();
      }
      $(this).attr('data-label', thText + ':');
    });
  })