var app = angular.module('myApp',['ui.router']);

app.config(function($stateProvider,$urlRouterProvider){
    $urlRouterProvider.otherwise('/');
    $stateProvider.state({
        name: 'home',
        url:'/',
        views:{
            '':{
                templateUrl: 'login.php',
                controller: 'loginCntr'
            }
        }
    }).state({
        name: 'profile',
        url:'/profile',
        templateUrl: 'profileinfo.php',
        controller: 'profileCntr'
    }).state({
        name: 'register',
        url:'/register',
        templateUrl: 'register.php',
        controller: 'registerCntr'
    }).state({
        name: 'logout',
        url:'/logout',
        controller: 'logoutCntr'
    }).state({
        name: 'addStudent',
        url:'/addStudent',
        templateUrl: 'student.php',
        controller: 'addStudentCntr'
    }).state({
        name: 'monitorClass',
        url:'/monitorClass',
        templateUrl: 'class.php',
        controller: 'monitorClassCntr'
    });

});

app.controller('monitorClassCntr',function($scope,$http,$location,sessionService,$rootScope){
    sessionService.checkSession();
    $scope.hideUpdate = true;
    $rootScope.showMenu = true;
    $scope.disableEdit = true;

    $scope.showSuccess = false;

    $http.get('http://localhost/angularphp/controller/getClasses.php').then(function(suc){
        $scope.classes = suc.data;
        // console.log($scope.classes);
    },function(err){
        console.log(err);
    });

    $scope.class_selected = function(){
        if($scope.selected_class == ''){
            $scope.students = '';
            $scope.student_detail = '';
        }else{
            var class_request = {
                    'method':'POST', 
                    'url':'http://localhost/angularphp/controller/enrolledStudents.php', 
                    'data':"class_id="+$scope.selected_class,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;'}
                };
            $http(class_request).then(function(suc){
                $scope.students = suc.data;
            },function(err){
                console.log(err);
            });
        }
        // console.log($scope.selected_class == '');
    }


    $scope.student_selected = function(){
        if($scope.selected_student == ''){
            $scope.student_detail = '';
        }else{
             var class_request = {
                    'method':'POST', 
                    'url':'http://localhost/angularphp/controller/studentDetail.php', 
                    'data':"student_id="+$scope.selected_student,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;'}
                };
            $http(class_request).then(function(suc){
                $scope.student_detail = suc.data;
                var avg1 = 0;
                for(key in suc.data){
                    avg1 += parseInt(suc.data[key].grade);
                }
                $scope.avg = avg1/suc.data.length;
                $scope.avg = $scope.avg.toPrecision(4);
            },function(err){
                console.log(err);
            });
        }
    }


});

app.controller('addStudentCntr',function($scope,$http,$location,sessionService,$rootScope){
    sessionService.checkSession();
    $scope.hideUpdate = true;
    $rootScope.showMenu = true;
    $scope.disableEdit = true;

    $scope.showSuccess = false;

     $http.get('http://localhost/angularphp/controller/getClasses.php').then(function(suc){
        $scope.classes = suc.data;
        // console.log($scope.classes);
    },function(err){
        console.log(err);
    });

    $scope.submit_student = function(){
        var server_req = {
                    'method':'POST', 
                    'url':'http://localhost/angularphp/controller/addStudent.php', 
                    'data':"student_name="+$scope.student_name+"&student_email="+$scope.student_email+"&class_id="+$scope.enrolled_class+"&garde="+$scope.score,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;'}
                };
        $http(server_req).then(function(suc){
            if(suc.data.statusmes == 'success'){
                $scope.showError = false;
                $scope.showSuccess = true;
            }else{
                $scope.showError = true;
                $scope.showSuccess = false;
                $scope.error = 'Failed to add new student';
            }
        },function(err){
            console.log(err);
            $scope.showError = true;
            $scope.showSuccess = false;
            $scope.error = 'Post request error';
        });
        // console.log($scope.student_name);
    }
});


app.controller('registerCntr',function($scope,$http,$location,sessionService,$rootScope){
    $rootScope.showMenu = false;
    $scope.showError = false;
    $scope.error_info = '';
    $scope.register_info = function(){
        var result = $http.post('http://localhost/angularphp/controller/testUser.php',{username:$scope.username});
        result.then(function(suc){
            // console.log(suc.data);
            if(suc.data.statusmes == 'success'){
                $scope.showError = false;
                $scope.error_info = '';
                if($scope.password == $scope.cpassword){
                    $http({
                            method: "post",
                            url: "http://localhost/angularphp/controller/registerUser.php",
                            data: {
                                username:$scope.username,
                                password:$scope.password,
                                primary_email:$scope.primary_email,
                                lastname:$scope.lastname,
                                firstname:$scope.firstname
                            }
                        }).then(
                            function(suc){
                                $location.path('/');
                            },function(err){
                                console.log(err);
                            }
                        );

                }else{
                    $scope.showError = true;
                    $scope.error_info = 'Passwords don\'t match.';
                }
            }else{
                $scope.showError = true;
                $scope.error_info = 'User name is already token.';
            }
        },function(err){
            $scope.showError = true;
            $scope.error_info = err;
        });
    }
});


app.service('sessionService',function($http,$location){
    this.checkSession = function(){
        $http.get('http://localhost/angularphp/controller/loginsession.php').then(
        function(suc){
            if(suc.data.statusmes == 'error'){
                $location.path('/');
            }else{
                //user session on server to retrive data
            }
            },function(err){
        });
    }
});


app.controller('logoutCntr',function($http,$location){
    $http.get('http://localhost/angularphp/controller/logout.php').then(
        function(suc){
            if(suc.data.statusmes=='ok'){
                $location.path('/');
            }else{
               console.log('The server returned value is not ok.'); 
            }
        },function(err){
            console.log(err);
        });

});

app.controller('loginCntr',function($rootScope,$scope,$http,$location){
    $rootScope.showMenu = false;
    $scope.showError = false;

    $http.get('http://localhost/angularphp/controller/loginsession.php').then(
            function(suc){
                if(suc.data.statusmes == 'error'){
                    
                }else{
                    $location.path('/profile');
                }
            },function(err){
                console.log(err);
            }
        );
    
    $scope.go_register = function(){
        $location.path('/register');
    };

    $scope.submit_info = function(){
        var req = {
            method: 'POST',
            url: 'http://localhost/angularphp/controller/loginsession.php',
            data: { username: $scope.username,
                    password:$scope.password }
        };

        $http(req).then(
            function(suc){
                if(suc.data.statusmes == 'ok'){
                    $location.path('/profile');                    
                }else{
                    $scope.showError = true;
                }
                
            }, function(err){
                $scope.showError = true;
        });
    };
    
});


app.controller('profileCntr',function($scope,$rootScope,sessionService,$http){
    sessionService.checkSession();
    $scope.hideUpdate = true;
    $rootScope.showMenu = true;
    $scope.disableEdit = true;
    var result = $http.get('http://localhost/angularphp/controller/getuserinfo.php');
    var d = new Date();
    var n = d.getHours();
    if(0<= n < 12){
        $scope.welcome = "Good Morning";
    }else if(12<=n<18){
        $scope.welcome = "Good Afternoon";
    }else{
        $scope.welcome = "Good Night";
    }

    result.then(function(suc){
        $scope.username = suc.data.username;
        // $scope.password = suc.data.password;
        // $scope.email = suc.data.primary_email;
        // $scope.phone = suc.data.phone;
        // $scope.lastname = suc.data.lastname;
        // $scope.firstname = suc.data.firstname;
        // console.log(suc);
    },function(err){
        console.log(err);
    });

});




