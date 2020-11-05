/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import * as $ from 'jquery';
import '../../public/plugins/jquery-ui/jquery-ui.min.js';
import 'admin-lte/plugins/jquery-validation/jquery.validate.min';
// import '../../public/plugins/summernote/lang/summernote-ru-RU.min.js';
import '../../public/plugins/summernote/summernote-bs4.min.js';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

$(document).ready(function () {

    $('#quickForm').validate({
        rules: {
            title: {
                required: 'Это поле обязательно к заполнению.',
                minlength: 5
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 5
            },
            terms: {
                required: true
            },
            content: {
                required: true,
                minlength: 5
            },
        },
        messages: {
            title: {
                required: 'Это поле обязательно к заполнению.',
                minlength: "Название должно содержать не меньше 3 символов."
            },
            email: {
                required: "Please enter a email address",
                email: "Please enter a vaild email address"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            content: {
                required: 'Это поле обязательно к заполнению.',
                minlength: "Контент должен содержать не меньше 5 символов."
            },
            terms: "Please accept our terms",
            required: 'Это поле обязательно к заполнению.'
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    $('form').each(function () {
        if ($(this).data('validator'))
            $(this).data('validator').settings.ignore = ".note-editor *";
    });

    // $('.summernote').summernote({
    //     height: 400
    // })
    // tiny.init({
    //     selector: '.summernote'
    // });
});

window.addEventListener('DOMContentLoaded', () => {

    $('.delete').click(function () {
        var $this = $(this);
        console.log(PATH, $this.attr('id'));

        var route = PATH + "posts/delete-post/" + $this.attr('id');
        $('.modal-delete-post form').attr('action', route)
    })

    menuActive('.nav-sidebar a');
    function menuActive($selector) {
        let active = document.body.querySelectorAll($selector);
        let location = window.location.protocol + '//' + window.location.host + window.location.pathname;

        active.forEach(item => {
            let href = item.href;
            if (location === href) {
                item.closest('.has-treeview').classList.add('menu-open');
                item.closest('.has-treeview') ? item.closest('.nav-link').classList.add('active') : null;
            }
        });


    }
})


