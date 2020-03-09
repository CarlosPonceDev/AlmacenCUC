/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.$ = window.jQuery = $;
import $ from 'jquery';
import "datatables.net-bs4";
import "select2";
import "awesome-notifications";

$('.select2').select2();