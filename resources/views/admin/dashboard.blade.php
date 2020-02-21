    <!-- File: ./resources/views/admin/dashboard.blade.php -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- This snippet will ensure that the correct token is always included in our frontend, Laravel provides the CSRF protection for us out of the box. -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <script> window.Laravel = { csrfToken: 'csrf_token() ' } </script>

        <title> Welcome to the Admin dashboard </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <style>
            html, body {
            background-color: #202B33;
            color: #738491;
            font-family: "Open Sans";
            font-size: 16px;
            font-smoothing: antialiased;
            overflow: hidden;
            }
        </style>
    </head>
    <body>
    <div id="app">
    <!-- For our app to work, we need a root element to bind our Vue instance unto. -->
      <Homepage 
        :user-name='@json(auth()->user()->name)' 
        :user-id='@json(auth()->user()->id)'
        :user-token='@json(auth()->user()->linkedin_access_token)'
      ></Homepage>
      <!-- We earlier defined the Homepage component as the wrapping component, that’s why we pulled it in here as the root component. 
      For some of the frontend components to work correctly, we require some details of the logged in admin user to perform CRUD operations. 
      This is why we passed down the userName and userId props to the Homepage component. -->
    </div>
      <!-- Our goal here is to integrate Vue into the application, so we included the resources/assets/js/app.js file with this line of code -->
      <script src="{{ asset('js/app.js') }}"></script>
    </body>
    </html>
