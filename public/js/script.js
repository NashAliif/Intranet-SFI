$(function () {
  $(".tombolTambahData").on("click", function () {
    $("#judulModal").html("Tambah Data");
    $(".modal-footer button[type=submit]").html("Tambah Data");
  });

  $(".tampilModalUbah").on("click", function () {
    $("#judulModal").html("Ubah Data");
    $(".modal-footer button[type=submit]").html("Ubah Data");
    $(".modal-body form").attr(
      "action",
      "http://localhost/Web%20Develop/PHP/MVC/1/public/mahasiswa/ubah"
    );

    const id = $(this).data("id");

    $.ajax({
      url: "http://localhost/Web%20Develop/PHP/MVC/1/public/mahasiswa/getubah",
      data: { id: id },
      method: "post",
      dataType: "JSON",
      success: function (data) {
        $("#nama").val(data.nama);
        $("#nrp").val(data.nrp);
        $("#email").val(data.email);
        $("#jurusan").val(data.jurusan);
        $("#id").val(data.id);
      },
    });
  });
});
