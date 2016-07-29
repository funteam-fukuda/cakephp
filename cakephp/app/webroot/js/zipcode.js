$(function() {
  $('#searchZipCode').click(function() {
    
    var data = {'data[PostalCode][request]': $('#PostalCodeRequest').val()};

    $.ajax({
      type: 'POST',
      url: 'http://blog.dev/cakephp/posts/zipcode',
      data: data,
      success: function(data, dataType) {
        if (data == "[]") {
          $('div#result_zipcode').css('display', 'none').empty();
          alert('検索結果がありません');
          return;
        }
        // json parse
        var json = $.parseJSON(data);
        var str = gen_address(json);
        $('div#result_zipcode').empty();
        $('div#result_zipcode').css('display', 'block').append(str);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        this;
        alert('Error:' + errorThrown);
      }
    });

    return false;
  });
});

function gen_address(json) {
  return json[0].PostalCode.state + json[0].PostalCode.city + json[0].PostalCode.street;
}