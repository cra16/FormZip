var app = angular.module('grouplist', []);

app.controller('ClubController', function($scope,$http) {
    $http.get('./club_api.php').
    success(function(data) {
        // here the data from the api is assigned to a variable named users
        $scope.list = data;
    });
    $scope.arr=["","공연/음악","스포츠","학술","전산","종교","봉사","전시"];
})


app.controller('AcademyController', function($scope,$http) {
    $http.get('./academy_api.php').
    success(function(data) {
        // here the data from the api is assigned to a variable named users
        $scope.list = data;
    });
    $scope.arr=["","창의융합교육원","경영경제","언론정보","전산전자","공간시스템","상담복지","글로벌리더쉽","국제어문","법","생명과학","콘텐츠융합디자인","GEA"];
})
