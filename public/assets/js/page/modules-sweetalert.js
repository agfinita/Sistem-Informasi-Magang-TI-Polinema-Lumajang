"use strict";

// Alert sudah tambah data
$(document).ready(function() {
    $('#create-form').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Clear previous error messages
        $('.error-message').remove();

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    swal('Success', 'Data baru berhasil ditambahkan!', 'success')
                    .then(() => {
                        window.location.href = redirectUrl; // Redirect after success
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Handle validation errors
                    swal('Oops', 'Data gagal ditambahkan', 'error').then(() => {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var inputField = $('input[name="' + key + '"]');
                            if (inputField.length) {
                                inputField.after('<div class="error-message" style="color: red; margin-top: 0.25rem;">' + value[0] + '</div>');
                            }

                            var textareaField = $('textarea[name="' + key + '"]');
                            if (textareaField.length) {
                                textareaField.after('<div class="error-message" style="color: red; margin-top: 0.25rem;">' + value[0] + '</div>');
                            }

                            var selectField = $('select[name="' + key + '"]');
                            if (selectField.length) {
                                selectField.after('<div class="error-message" style="color: red; margin-top: 0.25rem;">' + value[0] + '</div>');
                            }
                        });
                    });
                } else {
                    // Handle other errors
                    swal('Oops', 'Data gagal ditambahkan', 'error');
                }
            }
        });
    });
});

// Alert tambah data (file)
$(document).ready(function() {
    $('#create-form-data').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Clear previous error messages
        $('.error-message').remove();

        // Create FormData object
        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 'success') {
                    swal('Success', 'Data baru berhasil ditambahkan!', 'success')
                    .then(() => {
                        window.location.href = redirectUrl; // Redirect after success
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Handle validation errors
                    swal('Oops', 'Data gagal ditambahkan', 'error').then(() => {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var inputField = $('input[name="' + key + '"]');
                            if (inputField.length) {
                                inputField.after('<div class="error-message" style="color: red; margin-top: 0.25rem;">' + value[0] + '</div>');
                            }

                            var textareaField = $('textarea[name="' + key + '"]');
                            if (textareaField.length) {
                                textareaField.after('<div class="error-message" style="color: red; margin-top: 0.25rem;">' + value[0] + '</div>');
                            }

                            var selectField = $('select[name="' + key + '"]');
                            if (selectField.length) {
                                selectField.after('<div class="error-message" style="color: red; margin-top: 0.25rem;">' + value[0] + '</div>');
                            }
                        });
                    });
                } else {
                    // Handle other errors
                    swal('Oops', 'Data gagal ditambahkan', 'error');
                }
            }
        });
    });
});


// Alert update data
$(document).ready(function() {
    $('#update-form').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Clear previous error messages
        $('.error-message').remove();

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    swal('Success', 'Data berhasil diperbarui!', 'success')
                    .then(() => {
                        window.location.href = redirectUrl; // Redirect after success
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Handle validation errors
                    swal('Oops', 'Data gagal diperbarui', 'error').then(() => {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var inputField = $('input[name="' + key + '"]');
                            if (inputField.length) {
                                inputField.after('<div class="error-message" style="color: red; margin-top: 0.25rem;">' + value[0] + '</div>');
                            }

                            var textareaField = $('textarea[name="' + key + '"]');
                            if (textareaField.length) {
                                textareaField.after('<div class="error-message" style="color: red; margin-top: 0.25rem;">' + value[0] + '</div>');
                            }

                            var selectField = $('select[name="' + key + '"]');
                            if (selectField.length) {
                                selectField.after('<div class="error-message" style="color: red; margin-top: 0.25rem;">' + value[0] + '</div>');
                            }
                        });
                    });
                } else {
                    // Handle other errors
                    swal('Oops', 'Data gagal diperbarui', 'error');
                }
            }
        });
    });
});

// Alert update data (file)
$(document).ready(function() {
    $('#update-form-data').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Clear previous error messages
        $('.error-message').remove();

        // Create FormData object
        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 'success') {
                    swal('Success', 'Data berhasil diperbarui!', 'success')
                    .then(() => {
                        window.location.href = redirectUrl; // Redirect after success
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Handle validation errors
                    swal('Oops', 'Data gagal diperbarui', 'error').then(() => {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var inputField = $('input[name="' + key + '"]');
                            if (inputField.length) {
                                inputField.after('<div class="error-message" style="color: red; margin-top: 0.25rem;">' + value[0] + '</div>');
                            }

                            var textareaField = $('textarea[name="' + key + '"]');
                            if (textareaField.length) {
                                textareaField.after('<div class="error-message" style="color: red; margin-top: 0.25rem;">' + value[0] + '</div>');
                            }

                            var selectField = $('select[name="' + key + '"]');
                            if (selectField.length) {
                                selectField.after('<div class="error-message" style="color: red; margin-top: 0.25rem;">' + value[0] + '</div>');
                            }
                        });
                    });
                } else {
                    // Handle other errors
                    swal('Oops', 'Data gagal diperbarui', 'error');
                }
            }
        });
    });
});


// Alert error message
$(".swal-5").click(function () {
    swal('Failed', 'Data tidak ditemukan!' , 'error');
});

// Alert hapus data
$(".swal-6").click(function() {
    var id = $(this).data('id');
    swal({
            title: 'Yakin hapus data?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal('Data berhasil dihapus!', {
                    icon: 'success',
                }).then(() => {
                    $("#delete-form-" + id).submit();
                });
            } else {
                swal('Data batal dihapus.');
            }
        });
});
