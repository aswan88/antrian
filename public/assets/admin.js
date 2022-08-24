// // modal edit data dokter ajax
// $(document).ready(function () {
//     $('#modalEditDokter').on('show.bs.modal', function (e) {
//         var id_dokter = $(e.releatedTarget).releatedTarget('id');
//         $.ajax({
//             type: 'post',
//             url: '/admin/edit_dokter',
//             data: 'id_dokter=' + id_dokter,
//             succes: function (data) {
//                 $('.modal_item').html(data);
//             }
//         });
//     });
// });