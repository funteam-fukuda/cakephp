$(function() {
  $('#searchZipCode').click(function() {
    
    var val = $('#PostalCodeRequest').val();
    /* validation */
    if (val == '') {
      alert('郵便番号を入力して下さい');
      return;
    } else if (!val.match(/^\d{3}-?\d{4}$/)) {
      alert('入力形式が不正です');
      return;
    }
    val = val.replace('-', '');

    var data = {'data[PostalCode][request]': val};

    $.ajax({
      type: 'POST',
      url: 'http://blog.dev/cakephp/posts/zipcode',
      data: data,
      success: function(data, dataType) {
        if (data == "[]") {
          $('#result_zipcode').css('display', 'none').empty();
          alert('検索結果がありません');
          return;
        }
        /* json parse */
        var json = $.parseJSON(data);
        $('#result_zipcode').children().remove();
        gen_address(json);
        $('#result_zipcode').css('display', 'block');
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
  $.each(json, function(index, elem) {
    elem.PostalCode.street = elem.PostalCode.street.replace('以下に掲載がない場合', '');
    var address = elem.PostalCode.state + elem.PostalCode.city + elem.PostalCode.street;
    $('#result_zipcode').append('<option value="' + index + '">' + address + '</option>');
  });
}