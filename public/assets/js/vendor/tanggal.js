

var waktuindo=new Date()
var year=waktuindo.getYear()

if (year < 1000)
   year+=1900


var day=waktuindo.getDay()
var month=waktuindo.getMonth()
var daym=waktuindo.getDate()


if (daym<10)
   daym="0"+daym


var dayarray=new Array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu")
var montharray=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember")



document.write("<left>"+dayarray[day]+", "+daym+" "+montharray[month]+" "+year+"</left>")

