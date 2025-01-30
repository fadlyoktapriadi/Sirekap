document.querySelectorAll('.hapusbtn').forEach(button => {
    button.addEventListener('click', function(event) {
      event.preventDefault();
      const href = this.getAttribute('href');

      Swal.fire({
        title: "Apakah kamu yakin?",
        text: "Data ini akan dihapus!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Terhapus!",
            text: "Data berhasil dihapus.",
            icon: "success",
            showConfirmButton: false
          }).then(() => {
            window.location.href = href;
          });
          
        }
      });
    });
  });