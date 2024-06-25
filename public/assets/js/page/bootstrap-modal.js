"use strict";

$("#modal-1").fireModal({
    body: 'Modal body text goes here.'
});

// Modal detail pengumuman
$(document).ready(function() {
    $('#detailModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        $.ajax({
            url: `/mahasiswa/dashboard/${id}`,
            method: 'GET',
            success: function(data) {
                if (data.error) {
                    console.error(data.error);
                    return;
                }

                // Format created_at menggunakan moment.js
                let formattedDate = formatDate(data.created_at);

                let modalBody = `
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-6">
                                <b>Judul:</b>
                                <p>${data.judul}</p>
                            </div>
                        <div class="col-6">
                                <b>Penulis:</b>
                                <p>${data.created_by}</p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <b>Kategori:</b>
                                <p>${data.kategori}</p>
                            </div>
                            <div class="col-6">
                                <b>Waktu:</b>
                                <p id="waktu">${formattedDate}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                            <b>Deskripsi</b>
                                <div class="card p-3">
                                    <p class="card-text">${data.deskripsi}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                $('#detailModal .modal-body').html(modalBody);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});
// Format waktu
function formatDate(dateString) {
    return moment.utc(dateString).format('DD-MM-YYYY HH:mm:ss');
}

// $("#modal-2").fireModal({
//     body: 'Modal body text goes here.',
//     center: true
// });

let modal_3_body = '<p>Object to create a button on the modal.</p><pre class="language-javascript"><code>';
modal_3_body += '[\n';
modal_3_body += ' {\n';
modal_3_body += "   text: 'Login',\n";
modal_3_body += "   submit: true,\n";
modal_3_body += "   class: 'btn btn-primary btn-shadow',\n";
modal_3_body += "   handler: function(modal) {\n";
modal_3_body += "     alert('Hello, you clicked me!');\n"
modal_3_body += "   }\n"
modal_3_body += ' }\n';
modal_3_body += ']';
modal_3_body += '</code></pre>';
$("#modal-3").fireModal({
    title: 'Modal with Buttons',
    body: modal_3_body,
    buttons: [{
        text: 'Click, me!',
        class: 'btn btn-primary btn-shadow',
        handler: function (modal) {
            alert('Hello, you clicked me!');
        }
    }]
});

$("#modal-4").fireModal({
    footerClass: 'bg-whitesmoke',
    body: 'Add the <code>bg-whitesmoke</code> class to the <code>footerClass</code> option.',
    buttons: [{
        text: 'No Action!',
        class: 'btn btn-primary btn-shadow',
        handler: function (modal) {}
    }]
});

$("#modal-5").fireModal({
    title: 'Login',
    body: $("#modal-login-part"),
    footerClass: 'bg-whitesmoke',
    autoFocus: false,
    onFormSubmit: function (modal, e, form) {
        // Form Data
        let form_data = $(e.target).serialize();
        console.log(form_data)

        // DO AJAX HERE
        let fake_ajax = setTimeout(function () {
            form.stopProgress();
            modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

            clearInterval(fake_ajax);
        }, 1500);

        e.preventDefault();
    },
    shown: function (modal, form) {
        console.log(form)
    },
    buttons: [{
        text: 'Login',
        submit: true,
        class: 'btn btn-primary btn-shadow',
        handler: function (modal) {}
    }]
});

$("#modal-6").fireModal({
    body: '<p>Now you can see something on the left side of the footer.</p>',
    created: function (modal) {
        modal.find('.modal-footer').prepend('<div class="mr-auto"><a href="#">I\'m a hyperlink!</a></div>');
    },
    buttons: [{
        text: 'No Action',
        submit: true,
        class: 'btn btn-primary btn-shadow',
        handler: function (modal) {}
    }]
});

$('.oh-my-modal').fireModal({
    title: 'My Modal',
    body: 'This is cool plugin!'
});
