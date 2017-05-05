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
        name: 'message',
        url:'/message',
        templateUrl: 'message.php',
        controller: 'messageCntr',
    }).state('message.inbox_view',{
        url:'/inbox',
        templateUrl: 'inbox_view.php',
        controller: 'inboxCntr'
    }).state('message.sendbox_view',{
        url:'/sendbox',
        templateUrl: 'sendbox_view.php',
        controller: 'sendCntr'
    }).state('message.newmail_view',{
        url:'/newmail',
        templateUrl: 'newmail_view.php',
        controller: 'newCntr'
    });

});


app.directive('important',function(){
    return {
        templateUrl:'important_view.html',
        link:function(scope,elem,attrs){//place to write js code
            // console.log(elem);
            elem.bind('click',function(){//elem is the entiry directive
                var co = elem.css('color');
                if(co == "red"){
                  elem.css('color','black');
                }else{
                  elem.css('color','red');
                }
            });//bind event
        }
    };
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

app.controller('messageCntr',function($scope,$http,$location,sessionService,$rootScope){
    sessionService.checkSession();
    $rootScope.showMenu = true;

    $location.path('/message/inbox');
    // var result = $http.get('http://localhost/angularphp/controller/getMessages.php');

    // result.then(function(suc){
    //     $scope.sendMails = suc.data.sent;
    //     $scope.reciveMails = suc.data.inbox;
    //     $scope.username = suc.data.username;
    //     // console.log($scope.sendMails);

    // },function(err){
    //     console.log(err);
    // });

});


app.controller('inboxCntr',function($scope,sessionService,$rootScope,$http){
    sessionService.checkSession();
    $rootScope.showMenu = true;
    $scope.empty_box = false;
    $scope.reciveMails = [];

    var result = $http.get('http://localhost/angularphp/controller/getMessages.php');

    result.then(function(suc){

        $scope.reciveMails = suc.data.inbox;
        $scope.username = suc.data.username;
        // console.log($scope.reciveMails.length);
        if($scope.reciveMails.length == 0){
            $scope.empty_box = true;
        }
    },function(err){
        console.log(err);
    });

    $scope.deleteMail = function(dbIndex,tableIndex){
        $http({
            method: "post",
            url: "http://localhost/angularphp/controller/deleteMess.php",
            data: {
                id:dbIndex,
                table:'inbox_messages'
            }
        }).then(
            function(suc){
                console.log(suc);
            },function(err){

            }
        );

        // $http.post('http://localhost/angularphp/controller/loginsession.php').then(
        //     function(suc){

        //     },function(err){

        //     }
        // );
        // $scope.reciveMails.splice(tableIndex,1);
        // console.log(dbIndex);
        // console.log('$scope.reciveMails.length');
    }
});

app.controller('sendCntr',function($scope,sessionService,$rootScope,$http){
    sessionService.checkSession();
    $rootScope.showMenu = true;
    $scope.empty_box = false;
    $scope.sendMails = [];

    var result = $http.get('http://localhost/angularphp/controller/getMessages.php');

    result.then(function(suc){
        $scope.sendMails = suc.data.sent;
        $scope.username = suc.data.username;
        console.log($scope.sendMails.length==0);
        if($scope.sendMails.length == 0){
            $scope.empty_box = true;
        }
    },function(err){
        console.log(err);
    });
});

app.controller('newCntr',function(){

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

    result.then(function(suc){
        $scope.username = suc.data.username;
        $scope.password = suc.data.password;
        $scope.email = suc.data.primary_email;
        $scope.phone = suc.data.phone;
        $scope.lastname = suc.data.lastname;
        $scope.firstname = suc.data.firstname;
        // console.log(suc);
    },function(err){
        console.log(err);
    });

});
