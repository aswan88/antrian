window.setTimeout("waktu()", 1000);

function waktu() {
    var waktu = new Date();
    setTimeout("waktu()", 1000);
    waktu.getHours() + ':' + waktu.getMinutes() + ':' + waktu.getSeconds();
    document.getElementById("jam").innerHTML = waktu.getHours() + ':' + waktu.getMinutes() + ':' + waktu.getSeconds();
}


// javascript Admin Dokter

// $(function(){

//     $('#form_id').submit(function(event){
//     event.preventDefault();
//     var sip = $('#sip').val();
//     var nama_dokter = $('#nama_dokter').val();
//     var hari1 = $('#hari_prektek1').val();
//     var hari2 = $('#hari_prektek2').val();
//     var najam_buka = $('#jam_buka').val();
//     var jam_tutup = $('#jam_tutup').val();
    
//     $.ajax({
//             type: 'POST',
//             url: '/admin/tambah_dokter',
//             data: {
//              'name': custname,
//              'email': custemail
    
//             },
//             dataType: 'html',
//             success: function(results){
//                  if(something not as you expected){
//                   $('.error_msg').html('error msg');
//                   return false;
//                  }
//             }
//       });
    
    
//     });
    
//     });