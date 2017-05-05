<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://code.angularjs.org/1.5.5/angular.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.4.2/angular-ui-router.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.4.2/angular-ui-router.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/master.css">

  </head>
  <body>
    <div ng-app="myApp">
        <div class="header" ng-show="showMenu">
            <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="#">School Managment System</a>
                </div>
                <ul class="nav navbar-nav pull-right">
                <li><a ui-sref="profile" ui-sref-active="active">Profile</a></li>
                <li><a ui-sref="addStudent" ui-sref-active="active">Add Student</a></li>
                <li><a ui-sref="monitorClass" ui-sref-active="active">Monitor class</a></li>
                <li><a ui-sref="logout" ui-sref-active="active">Logout</a></li>
                </ul>
            </div>
            </nav>
        </div>
        
        <ui-view></ui-view>
    </div>

    <script src="js/app.js" charset="utf-8"></script>
  </body>
</html>
