var prop = [];
var ctr = 0;
var info = {};


$.getJSON ("data.json", function (data) {
  prop = data;
});

function do_mark ()
{
  if (playing) {
    if (cnt >= eqd.length) {
      ctr = 0;
      clearTimeout (timeout);
    } else {
      info.update (eqd[cnt].date, eqd[cnt].time)
      timeout = setTimeout ('do_mark ()', 200);
      ctr++;


      var circle = L.circle([prop[ctr].lat, [prop[ctr].long], [prop[ctr].jumlah, {
          color: 'red',
          fillColor: '#f03',
          fillOpacity: 0.5
      }).on('click', function() { alert('Clicked on a group!'); })
      .addTo(map);
    }
  }
}
