const flashData= $('.flash-data').data('flashdata');
// console.log(flashData);
// if(flashData){
//     Swal({
//         title: 'Berhasil  ',
//         text:  flashData,
//         type: 'success' ,
//     });
// }
// Swal.fire({
//     position: 'top-end',
//     icon: 'success',
//     title: flashData,
//     showConfirmButton: false,
//     timer: 1500
//   });
if(flashData){

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })
    
    Toast.fire({
      icon: 'success',
      text: flashData,
    })
}

  const flasherror=$('.flash-error').data('flasherror');
  if(flasherror){
      
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: flasherror,
        // footer: '<a href>Why do I have this issue?</a>'
      })
  }