var dmc = angular.module("dmc", ['ngSanitize', 'ngResource']);

dmc.factory('Numbers', function($resource) {
	return $resource('http://danielmccrohan.com/api/custom/get_numbers/',{ }, {
		getData: {method:'GET', isArray: false}
	});
});

dmc.config(function($routeProvider) {
	$routeProvider.when('/',
		{
			templateUrl: "wp-content/themes/dmc2013/templates/home.html",
			controller: "HomeCtrl"
		}).when('/books',
		{
			templateUrl: "wp-content/themes/dmc2013/templates/books.html",
			controller: "BooksCtrl"
		}).when('/book/:id',
		{
			templateUrl: "wp-content/themes/dmc2013/templates/book.html",
			controller: "SingleBookCtrl"
		}).when('/tv',
		{
			templateUrl: "wp-content/themes/dmc2013/templates/tv.html",
			controller: "TVCtrl"
		}).when('/tv/:id',
		{
			templateUrl: "wp-content/themes/dmc2013/templates/tv.html",
			controller: "SingleTVCtrl"
		}).when('/apps',
		{
			templateUrl: "wp-content/themes/dmc2013/templates/app.html",
			controller: "AppsCtrl"
		}).when('/app/:id',
		{
			templateUrl: "wp-content/themes/dmc2013/templates/app.html",
			controller: "SingleAppCtrl"
		}).when('/articles',
		{
			templateUrl: "wp-content/themes/dmc2013/templates/articles.html",
			controller: "ArticlesCtrl"
		}).otherwise({redirectTo:'/'});
});

dmc.filter('range', function() {
	return function(input, total) {
		total = parseInt(total);
		for (var i=0; i<total; i++)
			input.push(i);
		return input;
	};
});

dmc.filter('reverse', function() {
	return function(items) {
		if (items)
			return items.slice().reverse();
	};
});

dmc.directive('carousel', function() {
	return function(scope, elm, attrs) {
		scope.$watch(attrs.carousel, function() {
			window.slider.reloadSlider({
				onSliderLoad: function() {
					$(window.slider).find("li").each(function() {
						var title = $(this).find("img").attr("title");
						var decoded = $("<textarea>").html(title).val();
						$(this).find("span").text(decoded);
					});
				},
				auto: true,
				captions: true,
				mode: 'fade',
				pause: 6000
			});
		});
	}
});

function InfoCtrl($scope, $http) {
	var url = "http://danielmccrohan.com/api/custom/get_author_info/";
	//var url = "http://localhost/api/custom/get_author_info/";

	$scope.loadedyet = "notyet";
	$scope.photo = "";

	$http.get(url).
		success(function(data, status, headers, config) {
			$scope.info = data.info;
			$scope.photo = data.photo;
			$scope.loadedyet = "loaded";
		}).
		error(function(data, status, headers, config) {
			console.error('Error fetching books:', data);
		});
}

function HomeCtrl($scope, $http, Numbers) {

	$scope.loadedyet = "notyet";

	var url = "http://danielmccrohan.com/api/custom/get_latest_book/";

	$http.get(url).
		success(function(data, status, headers, config) {
			$scope.latestbook = data.book;
		}).
		error(function(data, status, headers, config) {
			console.error('Error fetching book:', data);
		});

	// Numbers.getData(function(data){
	// 	$scope.totalbooks = data.books.publish;
	// 	$scope.totaltvs = data.tvs.publish;
	// 	$scope.totalapps = data.apps.publish;
	// 	$scope.totalarticles = data.articles.publish;
	// 	$scope.totalpromos = data.promos.publish;
	// 	$scope.totalreviews = data.reviews.publish
	// });

	// //url = "http://danielmccrohan.com/api/custom/get_intros/";
	// url = "http://localhost/api/custom/get_intros/";

	// $http.get(url).
	// 	success(function(data, status, headers, config) {
	// 		$scope.booksintro = data.booksintro;
	// 		$scope.tvintro = data.tvintro;
	// 		$scope.appsintro = data.appsintro;
	// 		$scope.articlesintro = data.articlesintro;
	// 		$scope.loadedyet = "loaded";
	// 	}).
	// 	error(function(data, status, headers, config) {
	// 		console.error('Error fetching intros:', data);
	// 	});

	url = "http://danielmccrohan.com/api/custom/get_promos/";
	//url = "http://localhost/api/custom/get_promos/";

	$http.get(url).
		success(function(data, status, headers, config) {
			$scope.promos = data.promos;
			$scope.loadedyet = "loaded";
		}).
		error(function(data, status, headers, config) {
			console.error('Error fetching intros:', data);
		});
}

function BooksCtrl($scope, $http) {

	$scope.format = "icons";
	$scope.sortby = "date";

	var url = "http://danielmccrohan.com/api/custom/get_books/";
	//var url = "http://localhost/api/custom/get_books/";

	$http.get(url).
		success(function(data, status, headers, config) {
			$scope.books = data.books.sort(function(a,b) { 
				if(a.date > b.date) return -1;
				else if(a.date < b.date) return 1;
				else return 0;
			});
			$scope.$watch('sortby', function() {
				if($scope.sortby == "title") {
					$scope.books = $scope.books.sort(function(a,b) { 
						if(a.title < b.title) return -1;
						else if(a.title > b.title) return 1;
						else return 0;
					});
				} else if($scope.sortby == "publisher") {
					$scope.books = $scope.books.sort(function(a,b) { 
						if(a.publisher < b.publisher) return -1;
						else if(a.publisher > b.publisher) return 1;
						else return 0;
					});
				} else if($scope.sortby == "date") {
					$scope.books = $scope.books.sort(function(a,b) { 
						if(a.date > b.date) return -1;
						else if(a.date < b.date) return 1;
						else return 0;
					});
				}
			});

			$scope.$watch('books', function() {
				$scope.bookRows = splitIntoRows($scope.books, 4);
			}, true);
		}).
		error(function(data, status, headers, config) {
			console.error('Error fetching books:', data);
		});

	var splitIntoRows = function(booksarray, columns) {
		if (booksarray.length <= columns) {
		    return [booksarray];
		}
		var rowsNum = Math.ceil(booksarray.length / columns);
		var rowsArray = new Array(rowsNum);

		for (var i = 0; i < rowsNum; i++) {
			var columnsArray = new Array(columns);
			for (j = 0; j < columns; j++) {
				var index = i * columns + j;
				if (index < booksarray.length) {
					columnsArray[j] = booksarray[index];
				} else {
					columnsArray.pop();
					// break;
				}
			}
			rowsArray[i] = columnsArray;
		}
		return rowsArray;
	}

}
function SingleBookCtrl($scope, $routeParams, $http) {

	var url = "http://danielmccrohan.com/api/custom/get_book/?id=" + $routeParams.id;
	//var url = "http://localhost/api/custom/get_book/?id=" + $routeParams.id;

	$http.get(url).
		success(function(data, status, headers, config) {
			$scope.book = data.book;
		}).
		error(function(data, status, headers, config) {
			console.error('Error fetching book:', data);
		});
}
function TVCtrl($scope, $http) {
	var url = "http://danielmccrohan.com/api/custom/get_tvs/";
	//var url = "http://localhost/api/custom/get_tvs/";

	$http.get(url).
		success(function(data, status, headers, config) {
			$scope.tvs = data.tvs;
		}).
		error(function(data, status, headers, config) {
			console.error('Error fetching tvs:', data);
		});
}
function SingleTVCtrl($scope, $routeParams, $http) {

	$scope.loadedyet = "notyet";

	var url = "http://danielmccrohan.com/api/custom/get_tv/?id=" + $routeParams.id;
	//var url = "http://localhost/api/custom/get_tv/?id=" + $routeParams.id;

	$http.get(url).
		success(function(data, status, headers, config) {
			$scope.tv = data.tv;
			$scope.loadedyet = "loaded";
		}).
		error(function(data, status, headers, config) {
			console.error('Error fetching tv:', data);
		});
}
function AppsCtrl($scope, $http) {

	$scope.loadedyet = "notyet";

	var url = "http://danielmccrohan.com/api/custom/get_apps/";
	//var url = "http://localhost/api/custom/get_apps/";

	$http.get(url).
		success(function(data, status, headers, config) {
			$scope.apps = data.apps;
			$scope.loadedyet = "loaded";
		}).
		error(function(data, status, headers, config) {
			console.error('Error fetching apps:', data);
		});
}
function SingleAppCtrl($scope, $routeParams, $http) {

	$scope.loadedyet = "notyet";

	var url = "http://danielmccrohan.com/api/custom/get_app/?id=" + $routeParams.id;
	//var url = "http://localhost/api/custom/get_app/?id=" + $routeParams.id;

	$http.get(url).
		success(function(data, status, headers, config) {
			$scope.app = data.app;

			var url2 = "http://danielmccrohan.com/api/custom/get_reviews/?app=" + $scope.app.title;
			//var url2 = "http://localhost/api/custom/get_reviews/?app=" + $scope.app.title;

			$http.get(url2).
				success(function(data, status, headers, config) {
					$scope.reviews = data.reviews;
					$scope.loadedyet = "loaded";
				}).
				error(function(data, status, headers, config) {
					console.error('Error fetching reviews:', data);
				});
		}).
		error(function(data, status, headers, config) {
			console.error('Error fetching app:', data);
		});
}
function ArticlesCtrl($scope, $http) {

	$scope.loadedyet = "notyet";

	$scope.sortby = "date";

	var url = "http://danielmccrohan.com/api/custom/get_articles/";
	//var url = "http://localhost/api/custom/get_articles/";

	$http.get(url).
		success(function(data, status, headers, config) {
			$scope.articles = data.articles.sort(function(a,b) { 
				if(a.date > b.date) return -1;
				else if(a.date < b.date) return 1;
				else return 0;
			});
			$scope.loadedyet = "loaded";
			window.slider = $('.bxslider').bxSlider({
				auto: true,
				captions: true,
				mode: 'fade',
				pause: 6000
			});
			$scope.$watch('sortby', function() {
				if($scope.sortby == "title") {
					$scope.articles = $scope.articles.sort(function(a,b) { 
						if(a.title < b.title) return -1;
						else if(a.title > b.title) return 1;
						else return 0;
					});
				} else if($scope.sortby == "publisher") {
					$scope.articles = $scope.articles.sort(function(a,b) { 
						if(a.publisher < b.publisher) return -1;
						else if(a.publisher > b.publisher) return 1;
						else return 0;
					});
				} else if($scope.sortby == "date") {
					$scope.articles = $scope.articles.sort(function(a,b) { 
						if(a.date > b.date) return -1;
						else if(a.date < b.date) return 1;
						else return 0;
					});
				}
			});
		}).
		error(function(data, status, headers, config) {
			console.error('Error fetching articles:', data);
		});
}