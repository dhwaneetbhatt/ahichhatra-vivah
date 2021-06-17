$(document).ready(function () {

  // use native date type if browser supports it
  if (!Modernizr.inputtypes.date) {
    $('input[type=date]').datetimepicker({
      startDate: '1985/01/01',
      timepicker: false,
      format: 'Y-m-d'
    });
  }

  // use native time typel if browser supports it
  if (!Modernizr.inputtypes.time) {
    $('input[type=time]').datetimepicker({
      datepicker: false,
      format: 'h:i'
    });
  }

  var changeStatus = function (event) {
    var that = $(this);
    var id = that.attr('id');
    var status = event.data.status;
    var xsrfToken = getCookie('XSRF-TOKEN');
    if (id && status) {
      var profileId = parseInt(id.split('-')[2]);
      $.ajax({
        type: 'PUT',
        url: '/admin/profiles/' + profileId + '/status',
        headers: {
          'X-XSRF-TOKEN': xsrfToken,
        },
        data: { status: status },
        success: function () {
          alert('Profile ' + status.toLowerCase());
          $('#profile-' + profileId).remove();
        }
      });
    }
  }

  function getCookie(cname) {
    const name = cname + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
      const c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  $('.btn-accept').click({ status: 'INCOMPLETE' }, changeStatus);
  $('.btn-approve').click({ status: 'APPROVED' }, changeStatus);
  $('.btn-disapprove').click({ status: 'DISAPPROVED' }, changeStatus);
  $('.btn-delete').click({ status: 'DELETED' }, changeStatus);
  $('.btn-purge').click({ status: 'PURGE' }, changeStatus);
});