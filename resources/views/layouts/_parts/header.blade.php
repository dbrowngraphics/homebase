<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        Homebase 1.0
    </title>
    <meta name="description" content="Blank">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="{{ asset('css/vendors.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('css/app.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('css/custom.css') }}">
    <!-- Place favicon.ico in the root directory -->
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png"> -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-64x64.png') }}">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">


    <!-- <link rel="stylesheet" media="screen, print" href="{{asset('css/app.css')}}"> -->
    <!-- <link rel="stylesheet" media="screen, print" href="{{asset('css/smart4/datagrid/datatables/datatables.bundle.css')}}"> -->
    <!-- <link rel="stylesheet" media="screen, print" href="{{asset('css/custom.css')}}"> -->
    @yield('css')


    <style>
        table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
            white-space: nowrap;
        }
    </style>
</head>