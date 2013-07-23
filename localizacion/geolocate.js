var csv = require('csv');
var fs = require('fs');
var rest = require('restler');
// opts is optional
//var opts = ;

var sinLeer = 0;

fs.readFile('rest.csv', 'utf8', function(err, data) {
  csv()
  .from.string(data, { delimiter: ';', escape: '"'})
  .transform( function(row){
    row.unshift(row.pop());
    return row;
  })
  .on('record', function(row,index){
    //http://www.bingmapsportal.com/ISDK/AjaxV7#RESTServices1
    //http://dev.virtualearth.net/REST/v1/Locations/calle%20tirso%20de%20molina,%20santa%20cruz%20de%20tenerife,%20spain'?output=json&jsonp=SearchServiceCallback&key=Atd4AANQqGR8gSN4bTA523Dt2S48rbdpqjnei9zDlRw2Kisw0RC-qZkJOrvX8LT_
      if (index == 0) {
        var result = row[0] + ';' + row[1] + ';' + row[2] + ';' + row[3] + ';' + row[4] + ';' + row[5] + ';' + row[6] + ';' + row[7] + ';' + row[8] + ';' + row[9] + "\n" ;
        fs.appendFile('rest_out.csv', result);
      }
      else {
        var address = row[3] + ", " + row[9];
        var location = "http://dev.virtualearth.net/REST/v1/Locations/" + address + "?output=json&key=Atd4AANQqGR8gSN4bTA523Dt2S48rbdpqjnei9zDlRw2Kisw0RC-qZkJOrvX8LT_";
        rest.get(location).on('complete', function(resultado){
          var coords = ['0', '0'];
          if (( Object.prototype.toString.call( resultado ) === '[object Object]' ) && ('resourceSets' in resultado))
            coords = resultado['resourceSets'][0]['resources'][0]['geocodePoints'][0]['coordinates'];
          else
            sinLeer++;
          console.log(index + ' - ' + coords[0] +', ' + coords[1]);
          console.log("Coordenadas sin leer: " + sinLeer);
          var result = row[0] + ';' + row[1] + ';' + row[2] + ';' + row[3] + ';' + row[4] + ';' + row[5] + ';' + coords[0] + ';' + coords[1] + ';' + row[8] + ';' + row[9] + "\n"; 
          fs.appendFile('rest_out.csv', result, {encoding: 'utf8'});
        });
      }
  })
  .on('end', function(count) {
  })
  .on('close', function(count){
    // when writing to a file, use the 'close' event
    // the 'end' event may fire before the file has been written
    
    console.log('Number of lines: '+count);
  })
  .on('error', function(error){
    console.log(error.message);
  });
});